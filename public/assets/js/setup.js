const grid = document.getElementById("avatar-grid");
let selectedAvatar = null;
let previewMap = {}; // Maps avatar ID to preview div
let allModalAvatars = []; // List of all modal avatar divs

// Check if already logged in
fetch("/api/session", { credentials: "same-origin" })
  .then(res => res.json())
  .then(session => {
    if (session.loggedIn) {
      document.getElementById("signup-form").style.display = "none";
      const loggedInMessage = document.createElement("div");
      loggedInMessage.className = "setup-box";
      loggedInMessage.innerHTML = `
        <h1 class="setup-logo glow" onclick="window.location.href='/'" style="cursor: pointer;">WatchThis</h1>
        <h2>Welcome back, ${session.email}!</h2>
        <p style="text-align: center;">Looks like you're already signed up!</p>
        <button onclick="window.location.href='/'">Go to Homepage</button>
      `;
      document.querySelector(".setup-wrapper").appendChild(loggedInMessage);
      return;
    }

    // Only run avatar loading logic if NOT logged in
    fetch("/api/avatars")
      .then(res => res.json())
      .then(data => {
        const mainAvatars = data.slice(0, 4);

        // Preview grid (first 4 avatars)
        mainAvatars.forEach((pic, index) => {
          const div = document.createElement("div");
          div.className = "avatar-option";
          div.style.backgroundImage = `url(${pic.file_path})`;
          div.dataset.id = pic.id;
          previewMap[pic.id] = div;
          div.onclick = () => selectAvatar(div, true);
          grid.appendChild(div);
        });

        // "..." icon
        const more = document.createElement("div");
        more.className = "avatar-option more";
        more.innerText = "...";
        more.onclick = () => {
          document.getElementById("avatar-modal").style.display = "flex";
          updateModalSelectionHighlight();
        };
        grid.appendChild(more);

        const modalGrid = document.getElementById("avatar-modal-grid");
        data.forEach(pic => {
          const div = document.createElement("div");
          div.className = "avatar-option";
          div.style.backgroundImage = `url(${pic.file_path})`;
          div.dataset.id = pic.id;
          div.onclick = () => {
            selectAvatar(div, false);
            updatePreviewSelectionFromModal(div.dataset.id);
          };
          allModalAvatars.push(div);
          modalGrid.appendChild(div);
        });
      });
  });

function selectAvatar(div, fromPreview) {
  document.querySelectorAll(".avatar-option").forEach(el => el.classList.remove("selected"));
  div.classList.add("selected");
  selectedAvatar = div.dataset.id;
}

function updateModalSelectionHighlight() {
  allModalAvatars.forEach(div => {
    div.classList.toggle("selected", div.dataset.id === selectedAvatar);
  });
}

function updatePreviewSelectionFromModal(avatarId) {
  if (previewMap[avatarId]) {
    document.querySelectorAll("#avatar-grid .avatar-option").forEach(el => el.classList.remove("selected"));
    previewMap[avatarId].classList.add("selected");
  } else {
    // Replace the first preview avatar
    const previewAvatars = grid.querySelectorAll(".avatar-option:not(.more)");
    const firstPreview = previewAvatars[0];

    if (firstPreview) {
      delete previewMap[firstPreview.dataset.id];

      // Update with new avatar
      const newImage = getAvatarUrlById(avatarId);
      firstPreview.style.backgroundImage = newImage;
      firstPreview.dataset.id = avatarId;
      previewMap[avatarId] = firstPreview;

      // Highlighting selected avatar
      document.querySelectorAll("#avatar-grid .avatar-option").forEach(el => el.classList.remove("selected"));
      firstPreview.classList.add("selected");
    }
  }
}

function getAvatarUrlById(id) {
  // Pulls background image from modal
  const found = allModalAvatars.find(div => div.dataset.id === id);
  return found?.style.backgroundImage || "";
}

document.getElementById("signup-form").addEventListener("submit", async function (e) {
  e.preventDefault();
  const form = new FormData(this);

  const body = {
    username: form.get("username"),
    email: form.get("email"),
    password: form.get("password"),
    avatar: selectedAvatar
  };

  const res = await fetch("/api/signup", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(body)
  });

  const data = await res.json();
  if (res.ok) {
    window.location.href = "/user/signup/complete"; // Redirect to completion page
  } else {
    document.getElementById("signup-error").textContent = data.error || "Signup failed.";
  }
});

// Modal dismiss
document.getElementById("modal-close").onclick = () => {
  document.getElementById("avatar-modal").style.display = "none";
};
window.onclick = (e) => {
  if (e.target.id === "avatar-modal") {
    document.getElementById("avatar-modal").style.display = "none";
  }
};