<?php
chkLogin();
?>   <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="index.php">
                        <b>
                          <img src="../plugins/images/logo.png" alt="home" />
                        </b>
                       <span>
                            GREATER HEIGHT<!-- <img src="../plugins/images/logo-text.png" alt="homepage" class="dark-logo" />-->
                        </span> 
                    </a>
                </div> 
                <ul class="nav navbar-top-links navbar-left hidden-xs"> 
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                    <?php if($profile->adminLevel() == TRUE):?>
                    <li>
                        <form role="search" class="app-search hidden-xs" method="post">
                            <!-- <i class="icon-magnifier"></i> -->
                            <input type="text" placeholder="Search..." class="form-control" name="user">
                             <button class="btn btn-inline" name="userSearch"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </li><?php endif; ?>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle waves-effect waves-light font-20" data-toggle="dropdown" href="javascript:void(0);">
                            <i class="icon-speech"></i><?php if($profile->userMsgCount()>0): ?>
                            <span class="badge badge-xs badge-danger"><?php echo $profile->userMsgCount(); ?></span>
                          <?php else:  ?>
                          <span class="badge badge-xs badge-default"><?php echo $profile->userMsgCount(); ?></span>
                        <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu mailbox animated bounceInDown">
                            <li>
                                <div class="drop-title">You have <?php echo $profile->userMsgCount(); ?> new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                            
                                    <?php //echo $profile->adminMsg2(); ?> 
                                   
                                </div>
                            </li>
                          <li>
                             
                                    <?php
                                    echo MsgSubjectShow(); ?>
                                    <!-- <i class="fa fa-angle-right"></i> -->
                                
                            </li> 
                        </ul>
                    </li>

                    <li class="right-side-toggle">
                        <a class="right-side-toggler waves-effect waves-light b-r-0 font-20" href="profile.php">
                            <i class="icon-user"></i>
                            
                    </li>
                </ul>
            </div>
        </nav>