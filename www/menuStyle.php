<style>
/* NAVIGATION*/
.navbar-menu {
    background-color: #fafafa;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 50px;
    
}

.navbar-menu.active { transform: translateX(0);transition: 0.5s; }

.navbar-menu .menu-listing { padding: 0;margin: 0;text-align: left; }

.menu-listing li { display: inline-block; }

.menu-listing div button {
    background-color: #fff;
    color: #262626;
    display: block;
    font-size: 1rem;
    height: 50px;
    line-height: 50px;
    padding: 0 20px;
    letter-spacing: 1px;
    text-decoration: none;
    transition: 0.5s;
}

.menu-listing div button:hover { 
    background-color: #262626;color: #fff;transition: 0.5s; 
}




@media only screen and (max-width:767px) {

    .navbar-menu { height: auto;z-index:1; }
  
    .menu-listing .dropdown { display: block; }
    
    .navbar-menu .menu-listing { text-align: center; }
}
    
  /* The dropdown container */
.dropdown {
  float: left;
  overflow: hidden;
}





/* Dropdown content (hidden by default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 99999;
}

/* Links inside the dropdown */
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

/* Add a grey background color to dropdown links on hover */
.dropdown-content a:hover {
  background-color: #ddd;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}
</style>