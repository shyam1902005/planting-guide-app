const signinBtn = document.getElementById('signin-btn');
const profilePhotoContainer = document.getElementById('profile-photo-container');
const clientId = 'YOUR_CLIENT_ID_HERE213702005945-t52cr457itdmrusl8cmlpci9v9u9p4on.apps.googleusercontent.com'; // replace with your client ID

signinBtn.addEventListener('click', () => {
  // make API call to retrieve user profile information
  axios.get(`https://api.example.com/user/profile?client_id=${clientId}`)
    .then(response => {
      const userProfile = response.data;
      const userProfilePhoto = userProfile.photo_url;
      const img = document.createElement('img');
      img.src = userProfilePhoto;
      profilePhotoContainer.appendChild(img);
      profilePhotoContainer.style.display = 'block';
    })
    .catch(error => {
      console.error(error);
    });
});