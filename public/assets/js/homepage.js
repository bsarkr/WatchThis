let lastState = false;
let inSearchMode = false; // Flag to disable scroll-based header toggle during search

document.addEventListener("DOMContentLoaded", () => {
  fetch('/api/app-data', {
    credentials: 'same-origin'
  })
    .then(res => {
      if (!res.ok) throw new Error();
      return res.json();
    })
    .then(data => {
      if (data.currentUser) {
        document.querySelectorAll('.header-right .nav-btn, .compact-buttons .nav-btn').forEach(btn => {
          if (btn.textContent.includes("Log In") || btn.textContent.includes("Sign Up")) {
            btn.style.display = 'none';
          }
        });

        const watchlistBtn = document.createElement('button');
        watchlistBtn.textContent = 'Watch List';
        watchlistBtn.classList.add('nav-btn');
        watchlistBtn.onclick = () => window.location.href = '/watchlist';

        const friendsBtn = document.createElement('button');
        friendsBtn.textContent = 'Friends';
        friendsBtn.classList.add('nav-btn');
        friendsBtn.onclick = () => window.location.href = '/friends';

        const logout = document.createElement('button');
        logout.textContent = 'Logout';
        logout.classList.add('nav-btn');
        logout.onclick = () => fetch('/api/logout', {
          method: 'POST',
          credentials: 'same-origin'
        }).then(() => location.reload());

        const headerRight = document.querySelector('.header-right');
        const compact = document.querySelector('.compact-buttons');
        headerRight.innerHTML = '';
        compact.innerHTML = '';
        [watchlistBtn, friendsBtn, logout].forEach(btn => {
          headerRight?.appendChild(btn.cloneNode(true));
          compact?.appendChild(btn);
        });
      }
    })
    .catch(() => {});

  fetch('/api/movies')
    .then(res => res.json())
    .then(data => {
      console.log("Fetched data:", data);

      populateRow('movieTrending-row', data.movies?.trending);
      populateRow('movieTopRated-row', data.movies?.topRated);
      populateRow('movieRecent-row', data.movies?.recent);
      populateRow('movieAction-row', data.movies?.action);

      populateRow('tvTrending-row', data.tv?.trending);
      populateRow('tvTopRated-row', data.tv?.topRated);
      populateRow('tvRecent-row', data.tv?.recent);
      populateRow('tvAction-row', data.tv?.action);

      document.getElementById('loader').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    })
    .catch(err => {
      console.error('Error fetching movie data:', err);
      document.getElementById('loader').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    });

  const searchInputs = document.querySelectorAll('#movie-search, #compact-search');
  searchInputs.forEach(input => {
    input.addEventListener('keydown', event => {
      if (event.key === 'Enter') {
        searchMovies(input.value);
        searchInputs.forEach(field => field.value = input.value);
      }
    });
  });
});

function populateRow(rowId, movies) {
  const row = document.getElementById(rowId);
  if (!row || !movies || movies.length === 0) {
    console.warn(`Skipping ${rowId} — row not found or no movies`);
    return;
  }

  row.innerHTML = '';
  const scrollMovies = [...movies, ...movies, ...movies];

  scrollMovies.forEach(movie => {
    const tile = document.createElement('div');
    tile.className = 'movie-tile';
    tile.innerHTML = generatePosterHTML(movie);

    tile.addEventListener("click", () => {
      const id = movie.imdbId || movie.imdbID;
      const type = movie.type || (movie.episodeCount || movie.seasons ? "series" : "movie");
      window.location.href = `/details/${type}/${id}`;
    });

    row.appendChild(tile);
  });

  requestAnimationFrame(() => {
    const tile = row.querySelector('.movie-tile');
    if (tile) {
      row.scrollLeft = tile.offsetWidth * (movies.length + 2);
    }
  });

  row.addEventListener('scroll', () => {
    const tile = row.querySelector('.movie-tile');
    if (!tile) return;
    const tileWidth = tile.offsetWidth + 16;
    const totalTiles = movies.length;
    const scrollLeft = row.scrollLeft;
    const maxScroll = tileWidth * (totalTiles * 2 + 1);

    if (scrollLeft < tileWidth) {
      row.scrollLeft += tileWidth * totalTiles;
    } else if (scrollLeft > maxScroll - tileWidth) {
      row.scrollLeft -= tileWidth * totalTiles;
    }
  });
}

function searchMovies(inputValue = '') {
  const query = inputValue.trim().toLowerCase();
  const searchResults = document.getElementById('search-results');
  const content = document.getElementById('content');
  const loader = document.getElementById('search-loader');
  const mainHeader = document.getElementById('main-header');
  const scrolledHeader = document.getElementById('scrolled-header');

  searchResults.innerHTML = "";

  if (!query) {
    searchResults.style.display = 'none';
    loader.style.display = 'none';
    content.style.display = 'block';
    mainHeader.classList.remove('scrolled');
    scrolledHeader.style.display = 'none';
    lastState = false;
    inSearchMode = false;
    return;
  }

  const normalize = str => str.toLowerCase().replace(/[\s-]/g, '');

  if (!mainHeader.classList.contains('scrolled')) {
    mainHeader.classList.add('scrolled');
    scrolledHeader.style.display = 'flex';
    lastState = true;
  }

  inSearchMode = true; //disable scroll header switching
  loader.style.display = 'flex';
  content.style.display = 'none';
  searchResults.style.display = 'none';

  fetch(`/api/search?keyword=${encodeURIComponent(query)}`)
    .then(res => res.json())
    .then(results => {
      const normalizedQuery = normalize(query);

      const exactMatches = results.filter(item =>
        normalize(item.title || '').startsWith(normalizedQuery)
      );
      const relatedMatches = results.filter(item =>
        normalize(item.title || '').includes(normalizedQuery) &&
        !normalize(item.title || '').startsWith(normalizedQuery)
      );

      if (exactMatches.length > 0) {
        const exactSection = createSearchSection("Exact Matches", exactMatches);
        searchResults.appendChild(exactSection);
      }

      if (relatedMatches.length > 0) {
        const relatedSection = createSearchSection("Related Results", relatedMatches);
        searchResults.appendChild(relatedSection);
      }

      loader.style.display = 'none';
      searchResults.style.display = 'block';
    })
    .catch(err => {
      console.error("Search error:", err);
      loader.style.display = 'none';
      content.style.display = 'block';
    });
}

function createSearchSection(title, items) {
  const section = document.createElement('section');
  section.className = 'category-section';

  const heading = document.createElement('h2');
  heading.textContent = title;
  heading.className = 'search-section-title';

  const grid = document.createElement('div');
  grid.className = 'scroll-row';
  grid.style.overflow = 'visible';
  grid.style.flexWrap = 'wrap';
  grid.style.justifyContent = 'flex-start';
  grid.style.scrollSnapType = 'none';

  items.forEach(item => {
    const tile = document.createElement('div');
    tile.className = 'movie-tile';
    tile.innerHTML = generatePosterHTML(item);

    tile.addEventListener("click", () => {
      const id = item.imdbId || item.imdbID;
      const type = item.type || (item.episodeCount || item.seasons ? "series" : "movie");
      window.location.href = `/details/${type}/${id}`;
    });

    grid.appendChild(tile);
  });

  section.appendChild(heading);
  section.appendChild(grid);
  return section;
}

function createGrid(items) {
  const grid = document.createElement('div');
  grid.className = 'search-grid';

  items.forEach(item => {
    const tile = document.createElement('div');
    tile.className = 'movie-tile';
    tile.innerHTML = generatePosterHTML(item);
    grid.appendChild(tile);
  });

  return grid;
}

function generatePosterHTML(item) {
  const title = item.title || 'Untitled';
  const verticalPoster = item.imageSet?.verticalPoster?.w240;
  let imageUrl = '';

  if (verticalPoster && !verticalPoster.includes('image.svg')) {
    imageUrl = verticalPoster;
  } else if (item.fallbackPoster) {
    imageUrl = item.fallbackPoster;
  } else if (item.tmdbId) {
    const tmdbId = item.tmdbId.replace(/^(movie|tv|show)\//, '');
    imageUrl = `https://image.tmdb.org/t/p/w342/${tmdbId}.jpg`;
  }

  if (imageUrl) {
    return `<img src="${imageUrl}" alt="${title}"><p>${title}</p>`;
  } else {
    return `<div class="fallback-poster"><span>${title}</span></div>`;
  }
}

window.addEventListener("scroll", function () {
  if (inSearchMode) return; // skip scroll logic during search

  const header = document.getElementById("main-header");
  const scrollHeader = document.getElementById("scrolled-header");
  const scrollY = window.scrollY;

  if (scrollY > 180 && !lastState) {
    header.classList.add("scrolled");
    scrollHeader.style.display = "flex";
    lastState = true;
  } else if (scrollY < 100 && lastState) {
    header.classList.remove("scrolled");
    scrollHeader.style.display = "none";
    lastState = false;
  }
});