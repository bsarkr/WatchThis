

async function fetchMovies() {
    try {
        const response = await fetch("/api/movies");
        const movies = await response.json();
        const container = document.getElementById("movies-container");
        container.innerHTML = ""; //Clear previous movies
        
        movies.forEach(movie => {
            const card = document.createElement("div");
            card.classList.add("movie-card");

            const image = document.createElement("img");
            image.src = movie.posterURLs?.original || "https://via.placeholder.com/200";
            image.alt = movie.title;

            const title = document.createElement("div");
            title.classList.add("movie-title");
            title.textContent = movie.title;

            card.appendChild(image);
            card.appendChild(title);
            container.appendChild(card);
        });
    } catch (error) {
        console.error("Error fetching movies:", error);
    }
}

fetchMovies();

function searchMovies() {
    const query = $('#movie-search').val();
    $('#search-results').empty();

    if (query.trim() === "") return;

    $.get(`/api/movies/search/${encodeURIComponent(query)}`, function (movies) {
        movies.forEach(movie => {
            const card = `
                <div class="movie-card">
                    <a href="/movies/${movie.tmdb_type}/${movie.tmdb_id}">
                        <img src="${movie.poster_urls?.original || '#'}" alt="${movie.title}" />
                    </a>
                </div>
            `;
            $('#search-results').append(card);
        });
    });
}
