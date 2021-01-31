<!DOCTYPE html>  
<html>  
 <head>  
  <title></title>
  <?php
    session_start();
     include'assets/header.php';
     include "controller/class.Crud.php";
     $object=new Crud();
     $user_id='';
     $org_id=$_GET['id'];
     if(isset($_SESSION["user_name"]))
     {
      $user_id=$_SESSION["user_id"];
     }
     //var_dump($cmnt_id);
   ?>

   <style type="text/css">
     
     body {
         background: #eee
     }

     .date {
         font-size: 11px
     }

     .comment-text {
         font-size: 12px
     }

     .fs-12 {
         font-size: 12px
     }

     .shadow-none {
         box-shadow: none
     }

     .name {
         color: #007bff
     }

     .cursor:hover {
         color: blue
     }

     .cursor {
         cursor: pointer
     }

     .textarea {
         resize: none
     }
   </style>

 </head> 



 <!-- modal start -->
 <div class="modal" tabindex="-1" role="dialog" id="country_modal">
   <div class="modal-dialog " role="document">
     <div class="modal-content" id="country_modal_content">
     <!--   <div class="modal-header">
         <h5 class="modal-title">Modal title</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <p>Modal body text goes here.</p>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-primary">Save changes</button>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div> -->
     </div>
   </div>
 </div>
 <!-- modal end -->

 <!-- nabvar portion -->
 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
   <a class="navbar-brand" href="index.php">Logo</a>
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" href="business_org.php">Business Org</a>
     </li>
    <?php
      if(!isset($_SESSION["user_name"]))
      {
        echo '
          <li class="nav-item">
            <a class="nav-link" href="login/index.php">Login</a>
          </li>
         ';
      }
      else{
        echo ' 
          <li class="nav-item">
            <a class="nav-link" href="login/logout.php">Logout</a>
          </li>
         ';
      }
    ?>
   </ul>
 </nav>
 <br><br><br>
 <!-- nabvar portion end -->

 <body>  
  <div class="container">

    <div class="row">

      <div class="col-md-8">
          <div class="d-flex flex-column comment-section">
              <div class="bg-white p-2">
                  <div class="d-flex flex-row user-info">
                      <img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                      <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name">Marry Andrews</span><span class="date text-black-50">Shared publicly - Jan 2020</span></div>
                  </div>
                  <div class="mt-2">
                      <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  </div>
              </div>
              <?php
                if($user_id!='')
                {
                  echo '
                    <div class="bg-light p-2">
                      <form id="comment_form">
                        <div class="d-flex flex-row align-items-start"><img class="rounded-circle" src="https://i.imgur.com/RpzrMR2.jpg" width="40">
                          <textarea id="user_comment" class="form-control ml-1 shadow-none textarea"></textarea>
                        </div>
                        <div class="mt-2 text-right">
                          <button class="btn btn-primary btn-sm shadow-none" type="button" onclick="insert_comment('.$user_id.','.$org_id.')">Post comment</button>
                        </div>
                      </form>
                    </div>
                  ';
                }
                else{
                  echo ' 
                    <div class="bg-light p-2">
                      <small class="text-danger">Please sign in first...</small>
                    </div>
                  ';
                }
              ?>


          </div>
      </div>
      <div class="col-md-4">
        this is for ratings....
      </div>

    </div>

  </div>

  
 </body>  
</html>


<script type="text/javascript">

  function insert_comment(userId,orgId)
  {

    var user_id=userId;
    var org_id=orgId;
    var comment=$('#user_comment').val();
    if(comment=='')
    {
      alert('Please fill up the comment section...');
    }
    else{

      $.ajax({
        type:"POST",
        url:"api/organization_api.php",
        data:{user_id:user_id,org_id:org_id,comment:comment},
        success:function(data)
        {

        }
      });


    }

  }
</script>


