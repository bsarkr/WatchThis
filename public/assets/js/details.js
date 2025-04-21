document.addEventListener("DOMContentLoaded", async () => {
    const path = window.location.pathname.split('/');
    const type = path[2]; // movie or series
    const id = path[3];

    try {
        const res = await fetch(`/api/details/${type}/${id}`);
        const data = await res.json();

        if (!data || !data.title) return;

        const verticalPoster = data.poster?.w720 || data.poster?.w480 || data.poster?.w240;
        const fallbackPoster = data.fallbackPoster;
        const tmdbId = data.tmdbId?.replace(/^(movie|tv|show)\//, '');
        const tmdbPoster = tmdbId ? `https://image.tmdb.org/t/p/w500/${tmdbId}.jpg` : '';
        const defaultPoster = '/assets/images/fallback.jpg'; 

        const posterSrc = verticalPoster || fallbackPoster || tmdbPoster || defaultPoster;

        // Background blur
        const bg = document.getElementById('background');
        bg.style.backgroundImage = `url(${posterSrc})`;

        // Poster
        document.getElementById('poster').src = posterSrc;

        // Title
        document.getElementById('title').textContent = data.title;

        // Tags
        const tags = document.getElementById('tags');
        tags.innerHTML = ''; // clear any existing content
        if (Array.isArray(data.genres) && data.genres.length > 0) {
            data.genres.forEach(g => {
                const span = document.createElement('span');
                span.textContent = typeof g === 'string' ? g : g.name || '';
                if (span.textContent.trim() !== '') {
                    tags.appendChild(span);
                }
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

        // Streaming Platforms (removes duplicates by logo+name combo)
        const platformsDiv = document.getElementById('platforms');
        const seen = new Set();

        data.streamingPlatforms.forEach(p => {
            const key = `${p.logo}|${p.name}`;
            if (!seen.has(key)) {
                seen.add(key);
                const a = document.createElement('a');
                a.href = p.link;
                a.target = "_blank";
                a.innerHTML = `<img src="${p.logo}" alt="${p.name}" title="${p.name}" />`;
                platformsDiv.appendChild(a);
            }
        });

        // YouTube Trailer (if available)
        const trailerContainer = document.getElementById('trailer-container');
        if (data.trailer && data.trailer.youtubeVideoId) {
            const iframe = document.createElement('iframe');
            iframe.width = '100%';
            iframe.height = '400';
            iframe.src = `https://www.youtube.com/embed/${data.trailer.youtubeVideoId}?autoplay=0&rel=0`;
            iframe.frameBorder = '0';
            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
            iframe.allowFullscreen = true;
            iframe.className = 'trailer-video';
            trailerContainer.appendChild(iframe);
        }
    } catch (error) {
        console.error("❌ Failed to load details:", error);
        document.querySelector(".detail-container").innerHTML = `
            <div style="color:white;text-align:center;padding:50px;">
                <h2>Sorry, something went wrong loading this title.</h2>
                <p>${error.message}</p>
            </div>
        `;
    }
});