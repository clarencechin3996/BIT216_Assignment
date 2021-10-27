const username = document.getElementById('username');
const password = document.getElementById('password');
const loginform = document.getElementById('loginform');



form.addEventListener('submit', (e) =>{
  let messages = []
  if (username.value ==='' || username.value == null) {
    messages.push('Name is required')
  }
  if (messages.length >0) {
    e.preventDefault()
    errorElement.innerText = messages.join (', ')
  }

})
