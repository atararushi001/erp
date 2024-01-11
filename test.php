<div class="image-container">
  <img src="your-image.jpg" alt="Your image">
</div>

<style>
  .image-container {
  width: 300px; /* adjust the width of the container */
  height: 200px; /* adjust the height of the container */
  overflow: hidden; /* hide the overflow of the image */
}

.image-container img {
  width: 100%; /* make the image fill the container width */
  height: 100%; /* make the image fill the container height */
  object-fit: cover; /* crop the image to fit the container */
  object-position: center; /* center the image within the container */
  clip-path: polygon(0 0, 100% 0, 100% 50%, 50% 100%, 0 100%); /* define the custom polygon shape */
}
</style>