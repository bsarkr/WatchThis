


document.addEventListener("DOMContentLoaded", () => {
  fetch('/api/movies')
    .then(res => res.json())
    .then(data => {
      console.log("Fetched data:", data);
      populateRow('trending-row', data.trending);
      populateRow('topRated-row', data.topRated);
      populateRow('recent-row', data.recent);
      populateRow('action-row', data.action);
      
      document.getElementById('loader').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    })
    .catch(err => {
      console.error('Error fetching movie data:', err);
      document.getElementById('loader').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    });

  setupScrollArrows();
});

function populateRow(rowId, movies) {
  const row = document.getElementById(rowId);
  if (!row || !movies || movies.length === 0) {
    console.warn(`Skipping ${rowId} — row not found or no movies`);
    return;
  }

  row.innerHTML = '';

  // Create 3x copies for seamless scroll illusion
  const scrollMovies = [...movies, ...movies, ...movies];

  scrollMovies.forEach(movie => {
    const tile = document.createElement('div');
    tile.className = 'movie-tile';
    const imageUrl = movie.imageSet?.verticalPoster?.w240 || movie.fallbackPoster || 'https://via.placeholder.com/240x360';

    tile.innerHTML = `
      <img src="${imageUrl}" alt="${movie.title}">
      <p>${movie.title}</p>
    `;
    row.appendChild(tile);
  });

  // Jump to the middle set of movies
  requestAnimationFrame(() => {
    const tile = row.querySelector('.movie-tile');
    if (tile) {
      row.scrollLeft = tile.offsetWidth * movies.length;
    }
  });

  // Smooth infinite scroll handling
  row.addEventListener('scroll', () => {
    const tile = row.querySelector('.movie-tile');
    if (!tile) return;

    const tileWidth = tile.offsetWidth + 16; // tile width + gap
    const totalTiles = movies.length;
    const scrollLeft = row.scrollLeft;
    const maxScroll = tileWidth * totalTiles * 2;

    if (scrollLeft < tileWidth) {
      // too far left, jump forward
      row.scrollLeft = scrollLeft + tileWidth * totalTiles;
    } else if (scrollLeft > maxScroll - tileWidth) {
      // too far right, jump backward
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