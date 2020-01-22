<head>
<style>
/* Dropup Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropup content */
.dropup {
/* fixed讓這個 button 保持在 頁面 底端，即使scroll down 也不會變化 */
  position:fixed;
  /* width:300px;
  height:300px; */
  bottom:0px;
  right:25%;
  left:50%;
  margin-left:-25px;
/* 
  position: absolute;
  left:500px; 
  top:400px;
  display: inline-block; */
}

/* Dropup content (Hidden by Default) */
.dropup-content {
  display: none;
  position: absolute;
  bottom: 50px;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropup */
.dropup-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropup links on hover */
.dropup-content a:hover {background-color: #ddd}

/* Show the dropup menu on hover */
.dropup:hover .dropup-content {
  display: block;
}

/* Change the background color of the dropup button when the dropup content is shown */
.dropup:hover .dropbtn {
  background-color: #2980B9;
}
</style>
</head>

