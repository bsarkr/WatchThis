document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("login-form");

  if (!form) {
    console.error("Login form not found.");
    return;
  }

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const body = {
      email: formData.get("email"),
      password: formData.get("password")
    };

    try {
      const res = await fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(body),
        credentials: 'same-origin'
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