document.addEventListener("DOMContentLoaded", async () => {
  const loginForm = document.getElementById("login-form");
  const loggedInBox = document.getElementById("logged-in-box");
  const userEmailSpan = document.getElementById("user-email");
  const logoutBtn = document.getElementById("logout-btn");

  try {
    const sessionRes = await fetch("/api/session", { credentials: "same-origin" });
    const sessionData = await sessionRes.json();

    if (sessionData?.loggedIn) {
      loginForm.style.display = "none";
      loggedInBox.style.display = "block";
      userEmailSpan.textContent = sessionData.email;

      logoutBtn.addEventListener("click", async () => {
        await fetch("/api/logout", { method: "POST", credentials: "same-origin" });
        window.location.href = "/login";
      });
      return;
    }
  } catch (err) {
    console.error("Session check failed", err);
  }

  loginForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(loginForm);
    const body = {
      email: formData.get("email"),
      password: formData.get("password")
    };

    try {
      const res = await fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(body),
        credentials: "same-origin"
      });

      const data = await res.json();

      if (res.ok) {
        setTimeout(() => {
          window.location.href = "/";
        }, 100);
      } else {
        document.getElementById("login-error").textContent = data.error || "Login failed.";
      }
    } catch (err) {
      document.getElementById("login-error").textContent = "Something went wrong.";
      console.error(err);
    }
  });
});