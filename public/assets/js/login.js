document.getElementById('auth-form').addEventListener('submit', async function (e) {
    e.preventDefault();
  
    const form = new FormData(this);
    const isSignup = document.getElementById('signup_toggle').checked;
  
    const body = {
      username: form.get('username'),
      email: form.get('email'),
      password: form.get('password')
    };
  
    const url = isSignup ? '/api/signup' : '/api/login';
    const res = await fetch(url, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(body)
    });
  
    const data = await res.json();
    if (res.ok) {
      if (isSignup) {
        window.location.href = '/userSetupCompletion'; // NEXT STEP
      } else {
        window.location.href = '/'; // Home
      }
    } else {
      document.getElementById('auth-error').textContent = data.error || 'Something went wrong';
    }
  });