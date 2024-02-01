 <!-- plugins:js -->
 <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
 <!-- endinject -->
 <!-- Plugin js for this page -->
 <script src="./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <script src="./assets/js/hoverable-collapse.js"></script>
 <script src="./assets/js/template.js"></script>
 <script src="./assets/js/settings.js"></script>
 <script src="./assets/js/todolist.js"></script>
 <!-- endinject -->
 <!-- Custom js for this page-->
 <script src="./assets/js/jquery.cookie.js" type="text/javascript"></script>
 <!-- End custom js for this page-->
 <script src="./assets/vendors/select2/select2.min.js"></script>
 <script src="./assets/js/select2.js"></script>
 <script>
     // Set the target date (29th February 2024)
     const targetDate = new Date('2024-03-07').getTime();

     // Get the target element
     const targetElement = document.getElementById('targetElement');

     function updateOpacity() {
         // Get the current date
         const currentDate = new Date().getTime();

         // Calculate the difference in days
         const daysDifference = Math.floor((targetDate - currentDate) / (1000 * 60 * 60 * 24));

         // Set opacity based on days difference
         const opacity = daysDifference >= 0 ? 1 - (daysDifference / 100) : 0;

         // Apply opacity to the target element
         targetElement.style.opacity = opacity;

         // Uncomment the next line if you want to log the days difference for testing
         console.log("Days difference:", daysDifference);

         // Call the function again after a day (86400000 milliseconds)
         setTimeout(updateOpacity, 86400000);
     }

     // Initial call to start the process
     updateOpacity();
 </script>

 </body>

 </html>