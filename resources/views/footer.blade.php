<!-- Remove the container if you want to extend the Footer to full width. -->
<div class="mt-5 mb-0 pb-0">

   <footer>
    {{-- Footer here --}}
   </footer>
  
  </div>
  <!-- End of .container -->

  <script src="js/theme.bundle.js"></script>
  <script src="js/vendor.bundle.js"></script>
  
</body>
<style>

body{
overflow-x: hidden;
}

html{
overflow-x: hidden;
}

  .custom-login{
      height: 500px;
      padding-top: 100px;
  }

  .carousel-cell {
width: 28%;
height: 200px;
margin-right: 10px;

border-radius: 5px;
counter-increment: carousel-cell;
}

/* .carousel-cell.is-selected {
background: #ED2;
} */

/* cell number */
.carousel-cell:before {
display: block;
text-align: center;
content: counter(carousel-cell);
line-height: 200px;
font-size: 80px;
color: white;
}

.bg-grey{
  background-color: #fff;
}

/* .card{
  box-shadow: 0px 0px 4px 2px #00000026;
  border-radius: 20px;
  padding: 10px;
  height: 600px;
} */

.card-cart{
height: auto;
}

.product-card{
  /* box-shadow: 0px 0px 4px 2px #00000026; */
    border-radius: 20px;
    padding: 10px;
    height: 600px;
    /* background-color: #ffffff1a; */
}

.product-cart{
  border: none;
  background: none;
  color: #000;
  margin-top: auto;
  margin-bottom: auto;
  font-size: 30px;
}

.flex-2{
flex: 2;
padding-left: 3.05rem;
}
.flex-6{
flex: 6;
}
</style>
</html>