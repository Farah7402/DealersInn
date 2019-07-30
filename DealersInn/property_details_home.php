<?php

   include("library/checklogin.php");
  include ("library/opencon.php");

  if(isset($_GET["id"])){
    $pid=$_GET["id"];
    //echo $pid;
  }

?>

<?php
//index.php


$error = '';
$name = '';
$email1 = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email1"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email1 = clean_text($_POST["email1"]);
  if(!filter_var($email1, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }



 if($error == '')
 {
        $equery =
        "SELECT  users.fname, users.phone, users.email
           FROM  property 

        INNER JOIN users ON users.user_id=property.submitted_by
    
        WHERE property.property_id= ".$_GET["id"]."
         ";
        
        $eresult = mysqli_query($Conn,$equery);
        $numrows = mysqli_num_rows($eresult);

          if ($numrows == 0) 
          {
                 echo "<h1> No email send</h1>";
             
          }
while($arow = mysqli_fetch_array($eresult)){

  require 'class/class.phpmailer.php';
    $mail = new PHPMailer;
            
      $mail->IsSMTP();
      $mail->Host = "smtp.gmail.com";

      $mail->SMTPAuth = true;
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;
      $mail->Username = "farahjabeen024@gmail.com";
      $mail->Password = "78624011997FARAH@J";

       //Sets connection prefix. Options are "", "ssl" or "tls"
      $mail->From = $_POST["email1"];     //Sets the From email address for the message
      $mail->FromName = $_POST["name"];    //Sets the From name of the message
    //  $mail->setFrom($_POST["email1"], $_POST["name"]);//contact show
      
      $mail->AddAddress($arow["email"],$arow["fname"]);      
 
      //$mail->AddAddress('farahjabeen.2021@gmail.com',/*dealername*/);//Adds a "To" address
      $mail->AddCC($_POST["email1"], $_POST["name"]); //Adds a "Cc" address
      $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
      $mail->IsHTML(true);       //Sets message type to HTML    
      $mail->Subject = $_POST["subject"];    //Sets the Subject of the message
      $mail->Body = $_POST["message"];    //An HTML or plain text message body
  if($mail->Send())        //Send an Email. Return true on success or false on error
  {
   $error = '<label class="text-success">Thank you for contacting us</label>';
  }
  else
  {
   $error = '<label class="text-danger">There is an Error</label>';
  }
  $name = '';
  $email1 = '';
  $subject = '';
  $message = '';
 }

}




}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Dealer's INN</title>

<!-- Bootstrap -->
<link href="css/font.css" rel="stylesheet">
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate.css" rel="stylesheet">
<link href="lib/selectric/selectric.css" rel="stylesheet">
<link href="lib/swiper/css/swiper.min.css" rel="stylesheet">
<link href="lib/aos/aos.css" rel="stylesheet">
<link href="lib/Magnific-Popup/magnific-popup.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/selectric/jquery.selectric.js"></script>
<script src="lib/swiper/js/swiper.min.js"></script>
<script src="lib/aos/aos.js"></script>
<script src="lib/Magnific-Popup/jquery.magnific-popup.min.js"></script>
<script src="lib/sticky-sidebar/ResizeSensor.min.js"></script>
<script src="lib/sticky-sidebar/theia-sticky-sidebar.min.js"></script>
<script src="lib/lib.js"></script>
</head>
<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">

<?php include("header.php") ?>


<div id="main">

<div class="container">
  <div class="row justify-content-md-center">

      <?php

                                      $sql= "

                                      SELECT
                                  
                                                
                                               /*0*/       property.property_id,      
                                              /*1*/        property.property_title,
                                             /*2*/         property_types.types,      
                                             /*3*/         property.address,
                                            /*4*/          cities.city_name,
                                           /*5*/           propert_sale_rent.type, 
                                          /*6*/            property.property_price,
                                         /*7*/             property.area,
                                        /*8*/              meauring_units.unit_name
                
FROM property

INNER JOIN property_types ON property_types.property_type=property.property_type 
INNER JOIN cities ON cities.city_id=property.city_id 
INNER JOIN propert_sale_rent ON propert_sale_rent.property_for=property.property_for
INNER JOIN meauring_units ON meauring_units.meauring_unit=property.meauring_unit 


WHERE property.property_id= ".$_GET["id"]."
GROUP BY property.property_id

                                         
                              ";

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>


          <div class="col col-md-12 col-lg-12 col-xl-10">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><?php echo $row[2]?></a></li>
          <li class="breadcrumb-item"><a href="#">Property for <?php echo $row[5]?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $row[1]?></li>
        </ol>
      <div class="page-header bordered mb0">
        <div class="row">
          <div class="col-md-8">
            <h1><?php echo $row[1]?> <span class="label label-bordered">For <?php echo $row[5]?></span> <small><i class="fa fa-map-marker"></i><?php echo $row[3]?></small></h1>
          </div>
          <div class="col-md-4">
            <div class="price">Rs.<?php echo $row[6]?><small><?php echo $row[7]?>/<?php echo $row[8]?></small></div>
          </div>
        </div>
      </div>
    </div>
  </div>

                                     <?php
                                      }
                                      ?>
</div>

<div class="container">
  <div class="row justify-content-md-center">
          <div class="col col-md-12 col-lg-12 col-xl-10">
      <div class="item-gallery">
        <div class="swiper-container gallery-top" data-pswp-uid="1">
                  <div class="swiper-wrapper lazyload">
                    
                    <?php
                      $s=mysqli_query($Conn,"select * from p_images where property_id='$pid'");
                      while($s1=mysqli_fetch_array($s)) {
                    ?>
                    <div class="swiper-slide">
                    <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"> <a href="img/property/<?php echo $s1['images'] ?>" itemprop="contentUrl" data-size="2000x1414"> <img src="img/property/<?php echo $s1['images'] ?>" class="img-fluid swiper-lazy" alt="Drawing Room"> </a> </figure>
                    </div>
                   <?php  } ?>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
        <div class="swiper-container gallery-thumbs">
          <div class="swiper-wrapper">
            <?php
                      $s=mysqli_query($Conn,"select * from p_images where property_id='$pid'");
                      while($s1=mysqli_fetch_array($s)) {
                    ?>
            <div class="swiper-slide"><img src="img/property/<?php echo $s1['images'] ?>" class="img-fluid" alt=""></div>
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="content" class="item-single">
  <div class="container">
    <div class="row justify-content-md-center">
          <div class="col col-md-12 col-lg-12 col-xl-10">
        <div class="row row justify-content-md-center has-sidebar">
          <div class="col-md-7 col-lg-8">
            <div>

                                      <?php

                                      $sql= "

                                      SELECT
                                  
                                                
                                          /*0*/           property.property_id,
                                            /*1*/         property.area,
                                            /*2*/         meauring_units.unit_name,
                                            /*3*/         property.property_description,
                                            /*4*/         users.fname,
                                            /*5*/         users.lname,
                                            /*6*/         users.phone,
                                            /*7*/         users.email,
                                            /*8*/         property.property_title,
                                            /*9*/         propert_sale_rent.type


 /*10*/  
,MAX(IF(addition_features.feature = 'Rooms', property_additional_features.feature, NULL)) as `View`
 /*11*/ 
,MAX(IF(addition_features.feature = 'Washrooms', property_additional_features.feature, NULL)) as `View`
 /*12*/ 
,MAX(IF(addition_features.feature = 'Built in year', property_additional_features.feature, NULL)) as `View`  
 /*13*/   
,MAX(IF(addition_features.feature = 'Electricity Meter', property_additional_features.feature, NULL)) as `View`
 /*14*/ 
,MAX(IF(addition_features.feature = 'Gas Meter', property_additional_features.feature, NULL)) as `View`
 /*15*/ 
,MAX(IF(addition_features.feature = 'View', property_additional_features.feature, NULL)) as `View`
 /*16*/ 
,MAX(IF(addition_features.feature = 'Furnished', property_additional_features.feature, NULL)) as `View`
 /*17*/ 
,MAX(IF(addition_features.feature = 'Floor', property_additional_features.feature, NULL)) as `View`
 /*18*/ 
,MAX(IF(addition_features.feature = 'Business and Communication',property_additional_features.feature, 
NULL)) as `View`
 /*19*/ 
,MAX(IF(addition_features.feature = 'Nearby Facilities', property_additional_features.feature, NULL)) as `View`
 /*20*/ 
,MAX(IF(addition_features.feature = 'Other', property_additional_features.feature, NULL)) as `View`
  /*21*/
,MAX(IF(addition_features.feature = 'Kitchens', property_additional_features.feature, NULL)) as `View`
  FROM property

INNER JOIN meauring_units ON meauring_units.meauring_unit=property.meauring_unit 
INNER JOIN property_additional_features ON property_additional_features.property_id=property.property_id
INNER JOIN addition_features  ON addition_features.feature_id = property_additional_features.feature_id
INNER JOIN users ON users.user_id=property.submitted_by
INNER JOIN propert_sale_rent ON propert_sale_rent.property_for=property.property_for



WHERE property.property_id= ".$_GET["id"]."
GROUP BY property.property_id

                                         
                              ";

                                      $result=mysqli_query($Conn,$sql);
                                      while ($row=$result->fetch_array()) {

                                      ?>

              <div class="item-description">
                <h3 class="headline">Property description</h3>
             <?php echo $row[3]?><br>
              <?php echo $row[17]?>
              </div>


                       
              <h3 class="headline">Property Details</h3>
              <ul class="checked_list feature-list">
                <li><strong>Build Year:</strong> <?php echo $row[12]?></li>
                <li><strong>Electricity Meter:</strong><?php echo $row[13]?></li>
                <li><strong>Gas Meter:</strong><?php echo $row[14]?></li>
                <li><strong>View:</strong><?php echo $row[15]?></li>
                <li><strong>Furnished:</strong><?php echo $row[16]?></li>
                <li><strong>Floor:</strong><?php echo $row[17]?></li>
              </ul>
              
              <h3 class="headline">Property Features</h3>
              <ul class="checked_list feature-list">
                <li><?php echo $row[18]?></li>
                <li><?php echo $row[19]?></li>
                <li><?php echo $row[20]?></li>
              </ul>

            </div>
          </div>
          <div class="col-md-5 col-lg-4">
            <div id="sidebar" class="sidebar-right">
              <div class="sidebar_inner">
                <div id="feature-list" role="tablist">
                <div class="card">
                  <div class="card-header" role="tab" id="headingOne">
                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" href="#specification" aria-expanded="true" aria-controls="specification"> Specifications <i class="fa fa-caret-down float-right"></i> </a> </h4>
                  </div>
                  <div id="specification" class="panel-collapse collapse show" role="tabpanel">
                    <div class="card-body">
                      <table class="table v1">
                        <tr>
                          <td>Bedrooms</td>
                          <td><?php echo $row[10]?></td>
                        </tr>
                        <tr>
                          <td>Washrooms</td>
                          <td><?php echo $row[11]?></td>
                        </tr>
                         <tr>
                          <td>Kitchens</td>
                          <td><?php echo $row[21]?></td>
                        </tr>
                    
                        <tr>
                          <td>Total Area</td>
                          <td><?php echo $row[1]?>/<?php echo $row[2]?></td>
                        </tr>
                        <tr>
                          <td>Floor</td>
                          <td><?php echo $row[17]?></td>
                        </tr>
                      </table>
                    </div>
                  </div>

                 
                </div>
                </div>
                <div class="card shadow">
                  <h5 class="subheadline mt-0  mb-0">For <?php echo $row[9]?> by Dealer</h5>
                  <div class="media">
                    <div class="media-body">
                      <h4 class="media-heading"><?php echo $row[4]?> <?php echo $row[5]?></h4>
                      <p><a href="tel:01502392905"><i class="fa fa-phone" aria-hidden="true"></i> Call: <?php echo $row[6]?><br><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $row[7]?></a></p>
                      <a href="#" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#leadform">Request Details</a> </div>
                              
                 </div>
               <h4><?php echo $error; ?></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                   


   <div class="modal fade  item-badge-rightm" id="leadform" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="media">
          <div class="media-left"><img src="img/demo/property/thumb/1.jpg" width="60" class="img-rounded mt5" alt=""></div>
          <div class="media-body">
            <h4 class="media-heading"><?php echo $row[8]?></h4>
         </div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div> <?php 
                           } 
                          ?>


   <div class="modal-body">
            <form method="post">
      <div class="form-group">
       <label>Enter Name</label>
       <input type="text" name="name" placeholder="Enter Name" pattern="^[a-zA-Z ]*$" title="Alphabets only" class="form-control" required="" value="<?php echo $name; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Email</label>
       <input type="text" name="email1" class="form-control" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,}$" title="abc@gmail.com" required="" value="<?php echo $email1; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Telephone</label>
       <input type="text" name="subject" class="form-control" maxlength="15"
       pattern="^[\+]\d{2}-\d{3}-\d{7}$" title="Foramat +92-123-" required="" placeholder="+92-" value="<?php echo $subject; ?>" />
      </div>
      <div class="form-group">
       <label>Enter Message</label>
       <textarea name="message" class="form-control" required="" placeholder="Enter Message"><?php echo $message; ?></textarea>
      </div>
      <div class="form-group" align="center">
       
      </div>
     

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
       <button type="submit" name="submit" value="Submit" class="btn btn-primary"/>Request For Details</button>
        <!--button type="button" class="btn btn-primary">Request Details</button-->
     </div>
      </form>
    </div>
  </div>
</div>
  

  <?php include("footer.php") ?>
                    </div>
                  </div>
                 </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



</div>

  <?php include("footer.php") ?>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

          </div>

        </div>

</div>


<script type="text/javascript">
// Photoswipe

    var initPhotoSwipeFromDOM = function(gallerySelector) {
        var parseThumbnailElements = function(el) {
    console.log(el);
            var thumbElements = $(el).closest(main_gallery).find('figure'),
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for (var i = 0; i < numNodes; i++) {

                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes 
                if (figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if (figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if (linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if (!clickedListItem) {
                return;
            }
            var clickedGallery = clickedListItem.parentNode,
                childNodes = $(clickedListItem).closest(main_gallery).find('figure'),
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }
            if (index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {
                history: false,
                bgOpacity: 0.8,
                loop: false,
                barsSize: {
                    top: 0,
                    bottom: 'auto'
                },

                // define gallery index (for URL)
                galleryUID: $(galleryElement).closest(main_gallery).attr('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = document.querySelectorAll(main_gallery+' img')[index],
                        //var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return {
                        x: rect.left,
                        y: rect.top + pageYScroll,
                        w: rect.width
                    };
                }

            };

            options.index = parseInt(index, 10);

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
      gallery.shout('helloWorld', 'John' /* you may pass more arguments */);



            var totalItems = gallery.options.getNumItemsFn();

            function syncPhotoSwipeWithOwl() {
                var currentIndex = gallery.getCurrentIndex();
                galleryTop.slideTo(currentIndex);
                if (currentIndex == (totalItems - 1)) {
                    $('.pswp__button--arrow--right').attr('disabled', 'disabled').addClass('disabled');
                } else {
                    $('.pswp__button--arrow--right').removeAttr('disabled');
                }
                if (currentIndex == 0) {
                    $('.pswp__button--arrow--left').attr('disabled', 'disabled').addClass('disabled');
                } else {
                    $('.pswp__button--arrow--left').removeAttr('disabled');
                }
            };
            gallery.listen('afterChange', function() {
                syncPhotoSwipeWithOwl();
            });
            syncPhotoSwipeWithOwl();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll(gallerySelector);

        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }
    };
var main_gallery = '.gallery-top';
    var galleryTop = new Swiper(main_gallery, {
      spaceBetween: 10,
    lazy: {
    loadPrevNext: true,
    },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
    ,on: {
      init: function(){
        initPhotoSwipeFromDOM(main_gallery);
      },
    }
    });
    var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 10,
    centeredSlides: true,
    slidesPerView: 5,
      touchRatio: 0.2,
      slideToClickedSlide: true,
    });
    galleryTop.controller.control = galleryThumbs;
    galleryThumbs.controller.control = galleryTop;  
  </script>


</body>
</html>