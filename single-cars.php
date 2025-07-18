<?php get_header(); ?>
<?php 

$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: get_template_directory_uri() . '/assets/img/bg-img/97.jpg';

get_template_part('partials/content', 'breadcrumb', [
    'bg' => $bg_image
]);



 ?>

 <!-- Hotel Details Section -->
   <section class="hotel-details-section">
      <!-- Divider -->
      <div class="divider"></div>

      <div class="container">
         <!-- Hotel Details Header -->
         <div class="hotel-details-header mb-5">
            <div class="row g-5 align-items-end">
               <div class="col-12 col-lg-4">
                  <h2 class="mb-3"><?php the_title()?></h2>
                  <p class="mb-0 d-flex flex-wrap align-items-center gap-2">
                     <span>(16 Review)</span>
                     <span class="text-warning">
                        <i class="ti ti-star-filled"></i>
                        <i class="ti ti-star-filled"></i>
                        <i class="ti ti-star-filled"></i>
                        <i class="ti ti-star-filled"></i>
                        <i class="ti ti-star-filled"></i>
                     </span>
                     <span><i class="ti ti-map-pin text-success"></i> Bhutan, India, Pokhara</span>
                  </p>
               </div>

               <div class="col-12 col-lg-8">
                  <div class="d-flex flex-wrap align-items-center justify-content-md-end gap-4">
                     <a href="#">
                        <div class="icon">
                           <i class="ti ti-heart"></i>
                        </div>
                        <span>Save</span>
                     </a>

                     <a href="#">
                        <div class="icon">
                           <i class="ti ti-layout-rows"></i>
                        </div>
                        <span>Compare</span>
                     </a>

                     <a href="#">
                        <div class="icon">
                           <i class="ti ti-share"></i>
                        </div>
                        <span>Share</span>
                     </a>

                     <h2 class="mb-0">$450.00 Fixed</h2>
                  </div>
               </div>
            </div>
         </div>

         <img class="rounded-4" src="<?php echo $bg_image ?>" alt="">

         <div class="divider-sm"></div>

         <div class="row g-5">
            <div class="col-12 col-lg-8">
               <!-- Tour Details Content -->
               <div class="tour-details-content">
                  <h2>Overview</h2>
                 <?php the_content()?>

                 

                  <!-- Hotel Meta Info Card -->
                  <div class="hotel-meta-info-card">
                     <div class="row g-4">

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M22 21H2V19H3V4C3 3.73478 3.10536 3.48043 3.29289 3.29289C3.48043 3.10536 3.73478 3 4 3H18C18.2652 3 18.5196 3.10536 18.7071 3.29289C18.8946 3.48043 19 3.73478 19 4V9H21V19H22V21ZM17 19H19V11H13V19H15V13H17V19ZM17 9V5H5V19H11V9H17ZM7 11H9V13H7V11ZM7 15H9V17H7V15ZM7 7H9V9H7V7Z"
                                       fill="#3CB371" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>5 Star Hotel</h6>
                                 <p>Accommodation</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M22 21H2V19H3V4C3 3.73478 3.10536 3.48043 3.29289 3.29289C3.48043 3.10536 3.73478 3 4 3H18C18.2652 3 18.5196 3.10536 18.7071 3.29289C18.8946 3.48043 19 3.73478 19 4V9H21V19H22V21ZM17 19H19V11H13V19H15V13H17V19ZM17 9V5H5V19H11V9H17ZM7 11H9V13H7V11ZM7 15H9V17H7V15ZM7 7H9V9H7V7Z"
                                       fill="#3CB371" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>ID NO</h6>
                                 <p>#1250</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M3 5V19C3 20.103 3.897 21 5 21H19C20.103 21 21 20.103 21 19V5C21 3.897 20.103 3 19 3H5C3.897 3 3 3.897 3 5ZM19.002 19H5V5H19L19.002 19Z"
                                       fill="#3CB371" />
                                    <path d="M15 12H17V7H12V9H15V12ZM12 15H9V12H7V17H12V15Z" fill="#3CB371" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>Sqft</h6>
                                 <p>1869</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M2 19V13C2 12.55 2.09167 12.1417 2.275 11.775C2.45833 11.4083 2.7 11.0833 3 10.8V8C3 7.16667 3.29167 6.45833 3.875 5.875C4.45833 5.29167 5.16667 5 6 5H10C10.3833 5 10.7417 5.071 11.075 5.213C11.4083 5.355 11.7167 5.55067 12 5.8C12.2833 5.55 12.5917 5.35433 12.925 5.213C13.2583 5.07167 13.6167 5.00067 14 5H18C18.8333 5 19.5417 5.29167 20.125 5.875C20.7083 6.45833 21 7.16667 21 8V10.8C21.3 11.0833 21.5417 11.4083 21.725 11.775C21.9083 12.1417 22 12.55 22 13V19H20V17H4V19H2ZM13 10H19V8C19 7.71667 18.904 7.47933 18.712 7.288C18.52 7.09667 18.2827 7.00067 18 7H14C13.7167 7 13.4793 7.096 13.288 7.288C13.0967 7.48 13.0007 7.71733 13 8V10ZM5 10H11V8C11 7.71667 10.904 7.47933 10.712 7.288C10.52 7.09667 10.2827 7.00067 10 7H6C5.71667 7 5.47933 7.096 5.288 7.288C5.09667 7.48 5.00067 7.71733 5 8V10ZM4 15H20V13C20 12.7167 19.904 12.4793 19.712 12.288C19.52 12.0967 19.2827 12.0007 19 12H5C4.71667 12 4.47933 12.096 4.288 12.288C4.09667 12.48 4.00067 12.7173 4 13V15Z"
                                       fill="#3CB371" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>Bedroom</h6>
                                 <p>1 Bed</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M18.346 4.5H5.654C5.025 4.5 4.5 5.025 4.5 5.654V11.424C4.5 12.052 5.025 12.577 5.654 12.577H18.346C18.975 12.577 19.5 12.052 19.5 11.423V5.653C19.5 5.025 18.975 4.5 18.346 4.5Z"
                                       stroke="#3CB371" stroke-width="1.5" stroke-linecap="round"
                                       stroke-linejoin="round" />
                                    <path
                                       d="M16.6146 12.5772V10.2692C16.6146 9.64123 16.0896 9.11523 15.4616 9.11523H8.53664C7.90864 9.11523 7.38364 9.64123 7.38364 10.2692V12.5772M6.80664 18.3472C8.44664 18.3472 8.53664 16.7432 8.53664 15.4612M17.1906 18.3462C15.5506 18.3462 15.4606 16.7432 15.4606 15.4612M11.9996 19.5002V15.4612"
                                       stroke="#3CB371" stroke-width="1.5" stroke-linecap="round"
                                       stroke-linejoin="round" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>Air conditioner</h6>
                                 <p>01</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M7 15C7 15.2652 6.89464 15.5196 6.70711 15.7071C6.51957 15.8946 6.26522 16 6 16C5.73478 16 5.48043 15.8946 5.29289 15.7071C5.10536 15.5196 5 15.2652 5 15C5 14.7348 5.10536 14.4804 5.29289 14.2929C5.48043 14.1054 5.73478 14 6 14C6.26522 14 6.51957 14.1054 6.70711 14.2929C6.89464 14.4804 7 14.7348 7 15ZM10 15C10 15.2652 9.89464 15.5196 9.70711 15.7071C9.51957 15.8946 9.26522 16 9 16C8.73478 16 8.48043 15.8946 8.29289 15.7071C8.10536 15.5196 8 15.2652 8 15C8 14.7348 8.10536 14.4804 8.29289 14.2929C8.48043 14.1054 8.73478 14 9 14C9.26522 14 9.51957 14.1054 9.70711 14.2929C9.89464 14.4804 10 14.7348 10 15Z"
                                       fill="#3CB371" />
                                    <path
                                       d="M7 11L3 3.99999M17 11L21 3.99999M14 15H18M17.167 5.39699C16.7507 4.39144 16.0455 3.53195 15.1406 2.92724C14.2357 2.32253 13.1718 1.99976 12.0835 1.99976C10.9952 1.99976 9.93128 2.32253 9.02641 2.92724C8.12154 3.53195 7.41634 4.39144 7 5.39699"
                                       stroke="#3CB371" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                       d="M14.9651 6.65719C14.7827 6.03461 14.4035 5.48788 13.8843 5.09893C13.3651 4.70998 12.7338 4.49976 12.0851 4.49976C11.4363 4.49976 10.8051 4.70998 10.2858 5.09893C9.76663 5.48788 9.38744 6.03461 9.20508 6.65719"
                                       stroke="#3CB371" stroke-width="1.5" stroke-linecap="round" />
                                    <path
                                       d="M13.084 7C13.084 7.26522 12.9786 7.51957 12.7911 7.70711C12.6036 7.89464 12.3492 8 12.084 8C11.8188 8 11.5644 7.89464 11.3769 7.70711C11.1893 7.51957 11.084 7.26522 11.084 7C11.084 6.73478 11.1893 6.48043 11.3769 6.29289C11.5644 6.10536 11.8188 6 12.084 6C12.3492 6 12.6036 6.10536 12.7911 6.29289C12.9786 6.48043 13.084 6.73478 13.084 7Z"
                                       fill="#3CB371" />
                                    <path
                                       d="M13 19H6C4.114 19 3.172 19 2.586 18.414C2 17.828 2 16.886 2 15C2 13.114 2 12.172 2.586 11.586C3.172 11 4.114 11 6 11H18C19.886 11 20.828 11 21.414 11.586C22 12.172 22 13.114 22 15C22 16.886 22 17.828 21.414 18.414C20.828 19 19.886 19 18 19H17"
                                       stroke="#3CB371" stroke-width="1.5" stroke-linecap="round" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>Unlimited Wi-Fi</h6>
                                 <p>03</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                       d="M10.487 4.0402C11.1888 4.15565 11.8267 4.51665 12.287 5.05881C12.7472 5.60096 13 6.28901 13 7.0002V9.0002H7V7.0002C7 5.9612 7.528 5.0452 8.33 4.5072C8.04198 4.25074 7.68596 4.08303 7.30482 4.02425C6.92368 3.96547 6.53367 4.01814 6.18178 4.17592C5.82988 4.33369 5.5311 4.58983 5.32143 4.9135C5.11176 5.23717 5.00013 5.61455 5 6.0002V12.0002H21C21.2652 12.0002 21.5196 12.1056 21.7071 12.2931C21.8946 12.4806 22 12.735 22 13.0002C22 13.2654 21.8946 13.5198 21.7071 13.7073C21.5196 13.8948 21.2652 14.0002 21 14.0002V15.0002C21.0004 16.2413 20.616 17.4521 19.8996 18.4656C19.1832 19.4791 18.1702 20.2455 17 20.6592V21.0002C17 21.2654 16.8946 21.5198 16.7071 21.7073C16.5196 21.8948 16.2652 22.0002 16 22.0002C15.7348 22.0002 15.4804 21.8948 15.2929 21.7073C15.1054 21.5198 15 21.2654 15 21.0002H9C9 21.2654 8.89464 21.5198 8.70711 21.7073C8.51957 21.8948 8.26522 22.0002 8 22.0002C7.73478 22.0002 7.48043 21.8948 7.29289 21.7073C7.10536 21.5198 7 21.2654 7 21.0002V20.6592C5.82985 20.2455 4.81679 19.4791 4.1004 18.4656C3.38401 17.4521 2.99956 16.2413 3 15.0002V14.0002C2.73478 14.0002 2.48043 13.8948 2.29289 13.7073C2.10536 13.5198 2 13.2654 2 13.0002C2 12.735 2.10536 12.4806 2.29289 12.2931C2.48043 12.1056 2.73478 12.0002 3 12.0002V6.0002C2.99996 5.11568 3.29309 4.2561 3.83355 3.55591C4.37401 2.85571 5.13131 2.35441 5.98699 2.1304C6.84267 1.9064 7.74846 1.97233 8.56269 2.31788C9.37691 2.66344 10.0536 3.26912 10.487 4.0402ZM19 14.0002H5V15.0002C5 16.0611 5.42143 17.0785 6.17157 17.8286C6.92172 18.5788 7.93913 19.0002 9 19.0002H15C16.0609 19.0002 17.0783 18.5788 17.8284 17.8286C18.5786 17.0785 19 16.0611 19 15.0002V14.0002ZM10 6.0002C9.73478 6.0002 9.48043 6.10556 9.29289 6.29309C9.10536 6.48063 9 6.73498 9 7.0002H11C11 6.73498 10.8946 6.48063 10.7071 6.29309C10.5196 6.10556 10.2652 6.0002 10 6.0002Z"
                                       fill="#3CB371" />
                                 </svg>
                              </div>
                              <div>
                                 <h6>Bathtub</h6>
                                 <p>03</p>
                              </div>
                           </div>
                        </div>

                        <!-- Hotel Meta Info Card Item -->
                        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                           <div class="hotel-meta-info-card-item">
                              <div class="icon">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <g clip-path="url(#clip0_1_38830)">
                                       <path
                                          d="M23.6592 12.5977C23.8857 13.0977 23.999 13.6172 23.999 14.1562V15C23.999 15.2969 23.96 15.582 23.8818 15.8555C23.8037 16.1289 23.6865 16.3828 23.5303 16.6172C23.374 16.8516 23.1865 17.0625 22.9678 17.25C22.749 17.4375 22.5068 17.5938 22.2412 17.7188C22.124 17.9922 21.9717 18.2383 21.7842 18.457C21.5967 18.6758 21.3818 18.8594 21.1396 19.0078C20.8975 19.1562 20.6396 19.2773 20.3662 19.3711C20.0928 19.4648 19.8037 19.5078 19.499 19.5C18.96 19.5 18.46 19.3672 17.999 19.1016C17.5381 18.8359 17.1709 18.4688 16.8975 18H8.60059C8.32715 18.4688 7.95996 18.8359 7.49902 19.1016C7.03809 19.3672 6.53809 19.5 5.99902 19.5C5.45996 19.5 4.95996 19.3672 4.49902 19.1016C4.03809 18.8359 3.6709 18.4688 3.39746 18H1.49902C1.28809 18 1.09277 17.9609 0.913086 17.8828C0.733398 17.8047 0.577148 17.6992 0.444336 17.5664C0.311523 17.4336 0.202148 17.2734 0.116211 17.0859C0.0302734 16.8984 -0.00878906 16.7031 -0.000976562 16.5V13.5C-0.000976562 12.8828 0.116211 12.3008 0.350586 11.7539C0.584961 11.207 0.905273 10.7305 1.31152 10.3242C1.71777 9.91797 2.19434 9.59375 2.74121 9.35156C3.28809 9.10938 3.87402 8.99219 4.49902 9H4.93262L8.77637 5.15625C8.9873 4.94531 9.22949 4.78516 9.50293 4.67578C9.77637 4.56641 10.0654 4.50781 10.3701 4.5H20.999V6H20.6592L23.6592 12.5977ZM5.99902 18C6.20996 18 6.40527 17.9609 6.58496 17.8828C6.76465 17.8047 6.9209 17.6992 7.05371 17.5664C7.18652 17.4336 7.2959 17.2734 7.38184 17.0859C7.46777 16.8984 7.50684 16.7031 7.49902 16.5C7.49902 16.2891 7.45996 16.0938 7.38184 15.9141C7.30371 15.7344 7.19824 15.5781 7.06543 15.4453C6.93262 15.3125 6.77246 15.2031 6.58496 15.1172C6.39746 15.0312 6.20215 14.9922 5.99902 15C5.78809 15 5.59277 15.0391 5.41309 15.1172C5.2334 15.1953 5.07715 15.3008 4.94434 15.4336C4.81152 15.5664 4.70215 15.7266 4.61621 15.9141C4.53027 16.1016 4.49121 16.2969 4.49902 16.5C4.49902 16.7109 4.53809 16.9062 4.61621 17.0859C4.69434 17.2656 4.7998 17.4219 4.93262 17.5547C5.06543 17.6875 5.22559 17.7969 5.41309 17.8828C5.60059 17.9688 5.7959 18.0078 5.99902 18ZM13.499 6H10.3701C10.167 6 9.99121 6.07422 9.84277 6.22266L7.06543 9H13.499V6ZM14.999 9H20.3779L19.2178 6.43359C19.1553 6.30078 19.0615 6.19531 18.9365 6.11719C18.8115 6.03906 18.6748 6 18.5264 6H14.999V9ZM19.499 18C19.71 18 19.9053 17.9609 20.085 17.8828C20.2646 17.8047 20.4209 17.6992 20.5537 17.5664C20.6865 17.4336 20.7959 17.2734 20.8818 17.0859C20.9678 16.8984 21.0068 16.7031 20.999 16.5C20.999 16.2891 20.96 16.0938 20.8818 15.9141C20.8037 15.7344 20.6982 15.5781 20.5654 15.4453C20.4326 15.3125 20.2725 15.2031 20.085 15.1172C19.8975 15.0312 19.7021 14.9922 19.499 15C19.2881 15 19.0928 15.0391 18.9131 15.1172C18.7334 15.1953 18.5771 15.3008 18.4443 15.4336C18.3115 15.5664 18.2021 15.7266 18.1162 15.9141C18.0303 16.1016 17.9912 16.2969 17.999 16.5C17.999 16.7109 18.0381 16.9062 18.1162 17.0859C18.1943 17.2656 18.2998 17.4219 18.4326 17.5547C18.5654 17.6875 18.7256 17.7969 18.9131 17.8828C19.1006 17.9688 19.2959 18.0078 19.499 18Z"
                                          fill="#3CB371" />
                                    </g>
                                    <defs>
                                       <clipPath id="clip0_1_38830">
                                          <rect width="24" height="24" fill="white" />
                                       </clipPath>
                                    </defs>
                                 </svg>
                              </div>
                              <div>
                                 <h6>Parking</h6>
                                 <p>Years</p>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>

                  <h2>Features & Amenities</h2>
                  <ul class="list-unstyled style-two">
                     <li><i class="ti ti-rosette-discount-check"></i> Air Conditioning</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Swimming Pool</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Window Coverings</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Swimming Pool</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Recreation</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Equipped Kitchen</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Media Room</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Equipped Kitchen</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Smoke Detectors</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Equipped Kitchen</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Indoor Game</li>
                     <li><i class="ti ti-rosette-discount-check"></i> Natural Gas</li>
                  </ul>

                  
               </div>

              
            </div>

            <div class="col-12 col-lg-4">
               <div class="d-flex flex-column gap-5">
                  <!-- Widget -->
                  <div class="sidebar-widget">
                     <!-- Hotel Owner -->
                     <div class="hotel-owner mb-4">
                        <img src="assets/img/bg-img/151.jpg" alt="">
                        <h4>Darlene Robertson</h4>
                        <p class="mb-0">Hotel Owner</p>
                     </div>

                     <form action="#">
                        <div class="row g-4">
                           <div class="col-12">
                              <input type="text" class="form-control bg-white" placeholder="Name*">
                           </div>

                           <div class="col-12">
                              <input type="text" class="form-control bg-white" placeholder="Phone*">
                           </div>

                           <div class="col-12">
                              <input type="date" class="form-control py-0 bg-white">
                           </div>

                           <div class="col-12">
                              <textarea class="form-control bg-white" rows="20" cols="30"
                                 placeholder="Message *"></textarea>
                           </div>

                           <div class="col-12">
                              <button type="submit" class="btn btn-success rounded-2 w-100">Submit Now <i
                                    class="icon-arrow-right"></i></button>
                           </div>
                        </div>
                     </form>

                     <!-- Follow  -->
                     <div class="hotel-follow-nav mt-4">
                        <a href="#"><i class="ti ti-brand-facebook"></i></a>
                        <a href="#"><i class="ti ti-brand-x"></i></a>
                        <a href="#"><i class="ti ti-brand-instagram"></i></a>
                        <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Divider -->
      <div class="divider"></div>
   </section>




<?php get_footer(); ?>