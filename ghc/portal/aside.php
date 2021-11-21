      <aside class="sidebar">
            <div class="fixed-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image p-t-0">
                            <img src="photo/<?php echo $profile->userName('photo'); ?>" alt="user-img" class="img-circle">
                           <!-- <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li><a href="javascript:void(0);"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-inbox"></i> Messages</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-cog"></i> Account Settings</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href=""><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>-->
                        </div>
                        <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"><?php echo $profile->userName() ?></a></p>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        <li>
                            <a class="active waves-effect" href="." aria-expanded="false"><i class="icon-screen-desktop fa-fw"></i> <span class="hide-menu"> Dashboard </span></a>
                           
                        </li>
                      
                        <li>
                            <a class="active waves-effect" href="profile.php" aria-expanded="false"><i class="icon-user fa-fw"></i> <span class="hide-menu"> Profile </span></a>
                            
                        </li>

                        <!-- <li>
                            <a class="active waves-effect" href="accessloan.php" aria-expanded="false"><i class="icon-envelope-letter fa-fw"></i> <span class="hide-menu"> Loans </span></a>
                            
                        </li> -->

                        <li>
                            <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-share fa-fw"></i> <span class="hide-menu"> Loans </span></a>
                            <ul aria-expanded="true" class="collapse">
                            <?php if(!$profile->existData()): ?>
                                <li> <a href="accessloandata.php">Get a Loan</a> </li>
                            <?php else : ?>
                                <li> <a href="accessloan.php">Get a Loan</a> </li>
                                <li> <a href="loanstatus.php">Loan Status</a> </li><?php endif ; ?>
                               </ul>
                        </li>
                        <li>
                            <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-share fa-fw"></i> <span class="hide-menu"> Savings </span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li> <a href="savings.php">Initiate Savings</a> </li>
                                <li> <a href="savingsschedule.php">Savings Schedule</a> </li>
                            </ul>
                        </li>
                        <li>
                            <a class="active waves-effect" href="investment.php" aria-expanded="false"><i class="icon-user fa-fw"></i> <span class="hide-menu"> Investments </span></a>

                        </li>
<!--                        <li>-->
<!--                            <a class="active waves-effect" href="profile.php" aria-expanded="false"><i class="icon-envelope-letter fa-fw"></i> <span class="hide-menu"> Messages </span></a>-->
<!--                            -->
<!--                        </li>-->
                        <?php if($profile->adminLevel() == TRUE){  ?>
                        <li>
                            <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"><i class="icon-share fa-fw"></i> <span class="hide-menu"><b>Admin Operations</b> </span></a>
                            <ul aria-expanded="true" class="collapse">
                                <li> <a href="manage-users.php">Manage Users</a> </li>
                                <li> <a href="managesavings.php">Manage Savings </a> </li>
                                <li>
                                    <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"> <span class="hide-menu">Manage Loans</span></a>
                                    <ul aria-expanded="true" class="collapse">
                                        <li> <a href="loanapplication.php">Loan Application</a> </li>
                                        <li> <a href="approveloan.php">Approved Loan </a> </li>
                                        <li> <a href="disburse.php">Awaiting Disbursement</a> </li>
                                        <li> <a href="loandisburse.php">Disbursed Loans</a> </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="active waves-effect" href="javascript:void(0);" aria-expanded="false"> <span class="hide-menu">Manage Investments</span></a>
                                    <ul aria-expanded="true" class="collapse">
                                        <li> <a href="unactivatedinvestment.php">Un-Activated Investments</a> </li>
                                        <li> <a href="manageinvestment.php">Active Investments </a> </li>
                                        <li> <a href="expiredinvestment.php">Expired Investments</a> </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li>
                            <a class="active waves-effect" href="?process=logout" aria-expanded="false"><i class="icon-power fa-fw"></i> <span class="hide-menu"> Logout </span></a>
                            
                        </li>
                        <li>
                            <br><br><br><br><br><br>
                        </li>
      
                    </ul>

                       

                </nav>
               
            </div>
        </aside>