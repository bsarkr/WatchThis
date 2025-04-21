document.addEventListener("DOMContentLoaded", async () => {
    const pathParts = window.location.pathname.split('/');
    const type = pathParts[2]; // 'movie' or 'series'
    const id = pathParts[3];   // imdbID or whatever ID
  
    if (!id || !type) {
      document.getElementById("detail-container").innerHTML = "<p>Invalid link.</p>";
      return;
    }
  
    const response = await fetch(`/details/${type}/${id}`);
    const data = await response.json();

    if (!id || !type) {
        document.getElementById("detail-container").innerHTML = "<p>Invalid detail link.</p>";
        return;
      }
  
    if (!data || data.error) {
      document.getElementById("detail-container").innerHTML = "<p>Unable to fetch details.</p>";
      return;
    }
  
    renderDetails(data);
  });
  
  function renderDetails(data) {
    const container = document.getElementById("detail-container");
  
    container.innerHTML = `
      <div class="poster">
        <img src="${data.poster || '/assets/default-poster.png'}" alt="${data.title}">
      </div>
      <div class="info">
        <h1>${data.title} <span>(${data.year})</span></h1>
        <div class="meta">
          <span>${data.type.toUpperCase()}</span>
          <span>${data.duration || data.episodes}</span>
          <span>${data.country}</span>
          <span>⭐ ${data.imdb_rating}</span>
        </div>
        <p class="tagline">${data.tagline || ""}</p>
        <p class="desc">${data.description}</p>
  
        <p><strong>Director / Creator:</strong> ${data.director || data.creator}</p>
        <p><strong>Actors:</strong> ${data.cast?.join(", ")}</p>
  
        <h3>Available On:</h3>
        <ul class="platforms">
          ${data.streamingPlatforms.map(p => `<li>${p}</li>`).join("")}
        </ul>
      </div>
    `;
  }