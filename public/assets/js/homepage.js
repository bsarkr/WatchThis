document.addEventListener("DOMContentLoaded", () => {
  fetch('/api/movies')
    .then(res => res.json())
    .then(data => {
      console.log("Fetched data:", data);

      // movies
      populateRow('movieTrending-row', data.movies?.trending);
      populateRow('movieTopRated-row', data.movies?.topRated);
      populateRow('movieRecent-row', data.movies?.recent);
      populateRow('movieAction-row', data.movies?.action);

      // tv shows
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
});

function populateRow(rowId, movies) {
  const row = document.getElementById(rowId);
  if (!row || !movies || movies.length === 0) {
    console.warn(`Skipping ${rowId} — row not found or no movies`);
    return;
  }

  row.innerHTML = '';

  // Add buffer item to start and end for seamless looping
  const scrollMovies = [...movies, ...movies, ...movies];

  scrollMovies.forEach(movie => {
    const tile = document.createElement('div');
    tile.className = 'movie-tile';

    let imageUrl = '';
    const verticalPoster = movie.imageSet?.verticalPoster?.w240;

    if (verticalPoster && !verticalPoster.includes('image.svg')) {
      imageUrl = verticalPoster;
    } else if (movie.fallbackPoster) {
      imageUrl = movie.fallbackPoster;
    } else {
      imageUrl = 'https://via.placeholder.com/240x360';
    }

    tile.innerHTML = `
      <img src="${imageUrl}" alt="${movie.title}">
      <p>${movie.title}</p>
    `;
    row.appendChild(tile);
  });

  // Jump to the middle set start (with +2 offset for accurate alignment)
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
      row.scrollLeft = scrollLeft + tileWidth * totalTiles;
    } else if (scrollLeft > maxScroll - tileWidth) {
      row.scrollLeft = scrollLeft - tileWidth * totalTiles;
    }
  });
}

function searchMovies() {
  const query = document.getElementById('movie-search').value.trim();
  const searchResults = document.getElementById('search-results');
  searchResults.innerHTML = "";

  if (!query) return;

  fetch(`/api/movies?title=${encodeURIComponent(query)}`)
    .then(res => res.json())
    .then(movies => {
      populateRow('search-results', movies);
    })
    .catch(err => console.error("Error searching:", err));
}

// Header Scroll Transition
let lastState = false;
window.addEventListener("scroll", function () {
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