document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#review-form");
    const nameInput = document.querySelector("#name");
    const contentInput = document.querySelector("textarea#content");
    const reviewsContainer = document.querySelector("#reviews-container");
  
    if (!form || !nameInput || !contentInput) {
      console.error("One or more form elements are missing!");
      return;
    }
  
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
  
      const name = nameInput.value.trim();
      const content = contentInput.value.trim();
  
      if (!name || !content) return;
  
      const res = await fetch("/api/reviews", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ name, content }),
      });
  
      if (res.ok) {
        nameInput.value = "";
        contentInput.value = "";
        loadReviews();
      }
    });
  
    async function loadReviews() {
      const res = await fetch("/api/reviews");
      if (!res.ok) return;
  
      const reviews = await res.json();
      reviewsContainer.innerHTML = "";
  
      reviews.forEach((review) => {
        const div = document.createElement("div");
        div.className = "review-bubble";
        div.innerHTML = `
          <p>${review.content}</p>
          <div class="review-meta">– ${review.name} • ${new Date(review.created_at).toLocaleString()}</div>
        `;
        reviewsContainer.appendChild(div);
      });
    }
  
    loadReviews();
  });

// Sidebar toggle logic
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("sidebar");
  const hamburger = document.getElementById("hamburger");
  const closeBtn = document.getElementById("sidebar-close");

  if (hamburger && closeBtn && sidebar) {
    hamburger.addEventListener("click", () => {
      sidebar.classList.add("open");
    });

    closeBtn.addEventListener("click", () => {
      sidebar.classList.remove("open");
    });

    document.addEventListener("click", (e) => {
      if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
        sidebar.classList.remove("open");
      }
    });
  }
});