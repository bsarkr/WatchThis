document.addEventListener("DOMContentLoaded", async () => {
    const path = window.location.pathname.split('/');
    const type = path[2]; // movie or series
    const id = path[3];
  
    const res = await fetch(`/api/details/${type}/${id}`);
    const data = await res.json();
  
    if (!data || !data.title) return;
  
    // Background blur
    const bg = document.getElementById('background');
    bg.style.backgroundImage = `url(${data.poster.w720 || data.poster.w480 || data.poster.w240})`;
  
    // Poster
    document.getElementById('poster').src = data.poster.w480 || data.poster.w240;
  
    // Title
    document.getElementById('title').textContent = data.title;
  
    // Tags
    const tags = document.getElementById('tags');
    if (data.genres?.length) {
      data.genres.forEach(g => {
        const span = document.createElement('span');
        span.textContent = g.name;
        tags.appendChild(span);
      });
    }
    if (data.duration) {
      const runtime = document.createElement('span');
      runtime.textContent = `${Math.floor(data.duration / 60)}h ${data.duration % 60}m`;
      tags.appendChild(runtime);
    }
  
    // Description
    document.getElementById('description').textContent = data.description;
  
    // Director
    document.getElementById('director').textContent = data.director;
  
    // Cast
    document.getElementById('cast').textContent = data.cast.join(', ');
  
    // Streaming Platforms
    const platformsDiv = document.getElementById('platforms');
    data.streamingPlatforms.forEach(p => {
      const a = document.createElement('a');
      a.href = p.link;
      a.target = "_blank";
      a.innerHTML = `<img src="${p.logo}" alt="${p.name}" title="${p.name}" />`;
      platformsDiv.appendChild(a);
    });
  });