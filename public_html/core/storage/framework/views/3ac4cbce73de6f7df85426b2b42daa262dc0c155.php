

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('custom-css'); ?>
<style>
 #pdf-viewer {
  text-align: center;
  margin-top: 5px;
 }
 #canvas {
  border: 1px solid black;
  margin-top: 5px;
  cursor: none;
  max-width: 100%;  /* Ensure canvas scales with the width of the screen */
  height: auto;     /* Maintain aspect ratio */
  margin-top: 20px;
 }
 .canvas-container{
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding: 10px;     
 }
 button {
  font-size: 16px;
  padding: 10px 20px;
  cursor: pointer;
 }
 @media (max-width: 767px) {
  button {
   font-size: 14px;
   padding: 8px 16px;
  }
 }
 @media (max-width: 767px) {
  .canvas-container {
   padding: 10px;
  }
  button {
   font-size: 14px;
   padding: 8px;
  }
  canvas {
   width: 100%;  /* Full width for smaller screens */
   height: auto;
  }
 }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<main>
<section class="blog__area pt-100 pb-50 mt-5">
<div class="container"> 
<div class="row">
<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">

<div id="pdf-viewer">
 <button id="prev-page">Previous</button>
 <span>Page: <span id="page-num"></span> / <span id="page-count"></span></span>
 <button id="next-page">Next</button>
 
</div>

<div class="canvas-container">
 <canvas id="canvas"></canvas>
</div>
</div>
</div>

</div>
</section>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
 <script>
// If absolute URL from the remote server is provided, configure the CORS
// header on that server.
const url = 'https://www.computronicsmultivision.com/uploaded_files/certificate/<?php echo e($certificate); ?>';

let pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.getElementById('canvas'),
    ctx = canvas.getContext('2d');

    // Load PDF
    pdfjsLib.getDocument(url).promise.then(pdf => {
      pdfDoc = pdf;
      document.getElementById('page-count').textContent = pdfDoc.numPages;
      renderPage(pageNum);
    });

  // Render the page
 function renderPage(num) {
  pageRendering = true;
  pdfDoc.getPage(num).then(page => {
   const viewport = page.getViewport({ scale });
   canvas.height = viewport.height;
   canvas.width = viewport.width;

   const renderContext = {
     canvasContext: ctx,
     viewport: viewport
   };
    
   page.render(renderContext).promise.then(() => {
     pageRendering = false;
     if (pageNumPending !== null) {
       renderPage(pageNumPending);
       pageNumPending = null;
     }
   });
    
   document.getElementById('page-num').textContent = num;
  });
 }

 // Go to previous page
 document.getElementById('prev-page').addEventListener('click', () => {
  if (pageNum <= 1) return;
  pageNum--;
  renderPage(pageNum);
 });

 // Go to next page
 document.getElementById('next-page').addEventListener('click', () => {
  if (pageNum >= pdfDoc.numPages) return;
  pageNum++;
  renderPage(pageNum);
 });
 canvas.addEventListener('contextmenu', function (e) {
  e.preventDefault();  // This disables the right-click menu
}, false);

// Adjust scale based on viewport width
function adjustScaleForMobile() {
  const viewportWidth = window.innerWidth;
  if (viewportWidth < 768) { // For mobile screens
    scale = 1.0; // Smaller scale for mobile
  } else if (viewportWidth < 1024) { // For tablets
    scale = 1.2; // Medium scale for tablets
  } else {
    scale = 1.5; // Default scale for larger screens
  }
  renderPage(pageNum); // Re-render with updated scale
}

// Call adjustScaleForMobile on page load and resize
window.addEventListener('resize', adjustScaleForMobile);
adjustScaleForMobile();  // Initial adjustment

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/buy-with-confidence-detail.blade.php ENDPATH**/ ?>