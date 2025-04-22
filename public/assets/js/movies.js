document.addEventListener("DOMContentLoaded", () => {
    // Auth buttons
    fetch('/api/app-data', { credentials: 'same-origin' })
      .then(res => res.ok ? res.json() : null)
      .then(data => {
        if (data?.currentUser) {
          document.querySelectorAll('.compact-buttons .nav-btn').forEach(btn => {
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
  
          const compact = document.querySelector('.compact-buttons');
          [watchlistBtn, friendsBtn, logout].forEach(btn => compact.appendChild(btn));
        }
      });
  
    const genreSelect = document.getElementById("genre-select");
    const grid = document.getElementById("genre-results");
    const content = document.getElementById("movie-content");
    const searchResults = document.getElementById("search-results");
    const genreSection = document.querySelector('.movies-header');
    const searchLoader = document.getElementById("search-loader");
  
    genreSelect.addEventListener("change", async () => {
      const genre = genreSelect.value;
      grid.innerHTML = "";
      searchResults.innerHTML = "";
  
      if (!genre) {
        searchResults.style.display = "none";
        grid.style.display = "none";
        searchLoader.style.display = "none";
        content.style.display = "block";
        genreSection.style.display = "flex";
        return;
      }
  
      // Mimic search behavior
      searchLoader.style.display = "block";
      grid.style.display = "none";
      searchResults.style.display = "none";
      content.style.display = "none";
      genreSection.style.display = "flex";
  
      try {
        const res = await fetch(`/api/movies?genre=${genre}`);
        const data = await res.json();
      
        grid.innerHTML = "";
      
        if (!data || data.movies.length === 0) {
          grid.innerHTML = "<p>No movies found.</p>";
        } else {
            data.movies.forEach(movie => {
                const tile = document.createElement("div");
                tile.className = "movie-tile";
                tile.innerHTML = generatePosterHTML(movie);
              
                tile.addEventListener("click", () => {
                  const id = movie.imdbId || movie.imdbID;
                  const type = movie.type || (movie.episodeCount || movie.seasons ? "series" : "movie");
                  window.location.href = `/details/${type}/${id}`;
                });
              
                grid.appendChild(tile);
              });
        }
      
        searchLoader.style.display = "none";
        grid.style.display = "grid";
      } catch (err) {
        console.error("Genre fetch error:", err);
        searchLoader.style.display = "none";
        grid.innerHTML = "<p>Something went wrong.</p>";
        grid.style.display = "grid";
      }
    });
  
    // Search Bar Support
    const searchInput = document.querySelector('.compact-search input');
    searchInput.addEventListener('keydown', event => {
      if (event.key === 'Enter') {
        searchMovies(searchInput.value);
      }
    });
  
    fetch('/api/only-movies')
      .then(res => res.json())
      .then(data => {
        populateRow('movieNextWatch-row', data.movies?.nextWatch);
        populateRow('moviePopular-row', data.movies?.popular);
        populateRow('movieAction-row', data.movies?.action);
        populateRow('movieDrama-row', data.movies?.drama);
        populateRow('movieComedy-row', data.movies?.comedy);
        populateRow('movieThriller-row', data.movies?.thriller);
  
        document.getElementById('loader').style.display = 'none';
        content.style.display = 'block';
      })
      .catch(err => {
        console.error('Error loading movie data:', err);
        document.getElementById('loader').style.display = 'none';
        content.style.display = 'block';
      });
  });

  function populateRow(rowId, movies) {
    const row = document.getElementById(rowId);
    if (!row || !movies || movies.length === 0) return;
  
    row.innerHTML = '';
  
    [...movies, ...movies, ...movies].forEach(movie => {
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
      if (tile) row.scrollLeft = tile.offsetWidth * (movies.length + 2);
    });
  }
  
  function searchMovies(inputValue = '') {
    const query = inputValue.trim().toLowerCase();
    const searchResults = document.getElementById('search-results');
    const searchLoader = document.getElementById('search-loader');
    const content = document.getElementById('movie-content');
    const genreResults = document.getElementById('genre-results');
    const genreSection = document.querySelector('.movies-header');
    const genreSelect = document.getElementById("genre-select");
    const currentGenre = genreSelect.value;
  
    searchResults.innerHTML = "";
  
    if (!query) {
      searchResults.style.display = 'none';
      searchLoader.style.display = 'none';
  
      // If a genre is selected, restore the genre grid and header
      if (currentGenre) {
        genreResults.style.display = 'grid';
        if (genreSection) genreSection.style.display = 'flex';
        content.style.display = 'none';
      } else {
        genreResults.style.display = 'none';
        content.style.display = 'block';
        if (genreSection) genreSection.style.display = 'flex';
      }
  
      return;
    }
  
    // While searching, hide all other views
    searchResults.style.display = 'none';
    searchLoader.style.display = 'block';
    genreResults.style.display = 'none';         
    content.style.display = 'none';            
    if (genreSection) genreSection.style.display = 'none';  
    
    const normalize = str => str.toLowerCase().replace(/[\s-]/g, '');
  
    fetch(`/api/search?keyword=${encodeURIComponent(query)}`)
      .then(async res => {
        const text = await res.text();
        try {
          return JSON.parse(text);
        } catch (err) {
          console.error("Invalid JSON from /api/search:", text);
          return [];
        }
      })
      .then(results => {
        const normalizedQuery = normalize(query);
        searchResults.innerHTML = "";
  
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
  
        searchLoader.style.display = 'none';
        searchResults.style.display = 'block';
      })
      .catch(err => {
        console.error("Search error:", err);
        searchLoader.style.display = 'none';
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