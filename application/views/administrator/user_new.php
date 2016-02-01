<style>
    #applied1 {
        z-index: 1051 !important;
    }

    #due1 {
        z-index: 1051 !important;
    }

    #employ_modal {

        position: fixed;
        margin: -320px auto;
    }

    #comment {
        white-space: normal;
    }

    .nav-tabs-custom > .nav-tabs > li {
        margin-right: 0px;
    }


</style>

<div class="content-wrapper bg-real_estate">
    <section class="content-header">
        <h1 style="color: whitesmoke">
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Profile</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <div class="box box-primary transbox">
                    <div class="box-body box-profile">
                        <!--                        <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">-->
                        <form
                            action="<?php echo base_url() . 'administrator/user/update_profilePic' . '/' . $user->id; ?>"
                            method="post" id="banner" enctype="multipart/form-data">
                            <div class="form-group ">
                                <div class="panel-empty">
                                    <div class="panel-empty-inside">
                                        <div class="box-inside">
                                            <?php if (!profileImageExists(base_url() . 'uploads/profile/' . $this->session->userdata(PROFILE_PIC))) { ?>
                                                <a id="img" href="#"> <img alt="User profile picture"
                                                                           class="profile-user-img img-responsive img-circle"
                                                                           src="<?php echo base_url() . 'uploads/profile/empty_profile.jpg' ?>"></a>
                                            <?php } else { ?>
                                                <a id="img" href="#"> <img alt="User profile picture"
                                                                           class="profile-user-img img-responsive img-circle"
                                                                           src="<?php echo base_url() . 'uploads/profile/' . $user->profile_image; ?>"
                                                                           height="128px" width="128px"></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="file" onchange="this.form.submit()" name="profile_image" id="profile_image"
                                   style="display: none"/>
                        </form>
                        <h3 class="profile-username text-center"><?php echo $user->first_name . " " . $user->middle_initial . " " . $user->last_name; ?></h3>

                        <p class="text-muted text-center">
                            <?php echo $brokerMembership[0]->description; ?><br/>
                            <?php echo $clientMembership[0]->description; ?><br/>
                            <?php echo $ownerMembership[0]->description; ?><br/>
                        </p>

                        <ul class="list-group list-group-unbordered">

                            <?php
                            $timestamp = strtotime($member_since->start_date);
                            $created_date = date('m/d/Y', $timestamp);

                            ?>

                            <li class="list-group-item">
                                <b>Member Since</b> <a class="pull-right"><?php echo $created_date; ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Last Login</b> <a class="pull-right"><?php echo date('m/d/Y', strtotime($user->last_login_date)); ?></a>
                            </li>

                            <?php if (in_array('broker', $roles)) : ?>
                                <li class="list-group-item">
                                    <b>Brokers</b> <a class="pull-right"><?php
                                        if ($total_brokers != 0) {
                                            echo $total_brokers;
                                        } else {
                                            echo '0';
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Clients</b> <a class="pull-right"><?php
                                        if ($total_clients != 0) {
                                            echo $total_clients;
                                        } else {
                                            echo '0';
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Owners</b> <a class="pull-right"><?php
                                        if ($total_owners != 0) {
                                            echo $total_owners;
                                        } else {
                                            echo '0';
                                        }
                                        ?></a>
                                </li>


                                <li class="list-group-item">
                                    <b>Tradelines</b> <a class="pull-right">

                                        <?php if ((in_array('broker', $roles)) && (in_array('owner', $roles))) {
                                            echo $my_lines + $to_lines;
                                        } elseif ((in_array('owner', $roles))) {
                                            echo $to_lines;
                                        } elseif ((in_array('broker', $roles))) {
                                            echo $my_lines;
                                        } elseif ((in_array('client', $roles))) {
                                            echo $active_lines;
                                        }
                                        ?>


                                    </a>
                                </li>


                            <?php endif; ?>


                            <li class="list-group-item">
                                <b>Employments</b> <a class="pull-right"><?php echo count($employ); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Applications</b> <a class="pull-right"><?php echo count($application); ?></a>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="box box-primary transbox" id="about_me">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Lastest Employment</strong>

                        <p class="text-muted">

                            <?php foreach ($about_employ as $employees) { ?>
                                <?php echo strtoupper($employees->company) . ", " . strtoupper($employees->street_employment) . ", " . strtoupper($employees->city_employment); ?>
                            <?php } ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Residence</strong>

                        <p class="text-muted"><?php echo strtoupper($user->city) . ", " . strtoupper($user->state); ?></p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Roles</strong>

                        <p>
                            <?php if (in_array('super_admin', $roles)) : ?>
                                <span class="label label-danger">Super Admin</span>
                            <?php endif; ?>

                            <?php if (in_array('admin', $roles)) : ?>
                                <span class="label label-success">Admin</span>
                            <?php endif; ?>

                            <?php if (in_array('broker', $roles)) : ?>
                                <span class="label label-info">Broker</span>
                            <?php endif; ?>

                            <?php if (in_array('client', $roles)) : ?>
                                <span class="label label-warning">Client</span>
                            <?php endif; ?>

                            <?php if (in_array('owner', $roles)) : ?>
                                <span class="label label-primary">Owner</span>
                            <?php endif; ?>
                        </p>

                        <hr>


                        <strong><i class="fa fa-file-text-o"></i> Notes</strong>

                        <div style="width: 100%;">
                            <a href="#" id="comment" data-type="textarea">
                                <?php
                                echo $user->comment;
                                ?>
                            </a>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom transbox">
                    <ul class="nav nav-tabs">
                        <li id="per" class="active"><a href="#personal" id="pers" data-toggle="tab">Personal</a></li>
                        <li style="background: lightgray;" id="member"><a href="#membershiptab" id='mems'
                                                                          data-toggle="tab">Membership</a></li>

                    </ul>

                    <div class="tab-content" id="main_content">
                        <div class="active tab-pane" id="personal">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($this->session->flashdata('message')) { ?>
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                <?php echo $this->session->flashdata('message'); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Name : </label>
                                            </div>

                                            <div class="form-group col-md-7">

                                                <a href="#" id="first_name"><?php echo $user->first_name ?></a>
                                                <?php if ($user->middle_initial) { ?>
                                                    <a href="#" id="middle_initial"
                                                       data-type="text"><?php echo $user->middle_initial ?></a>
                                                <?php } ?>
                                                <a href="#" id="last_name"
                                                   data-type="text"> <?php echo $user->last_name ?></a>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Gender : </label>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <a href="#" id="gender" data-type="select"
                                                   data-value="<?php echo $user->gender ?>"
                                                   data-source="[{value:'M',text:'Male'},{value:'F',text:'Female'}]">
                                                    <?php echo $user->gender ?></a>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>S.S.N : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#"
                                                   id="<?php echo ($user->id == $this->session->userdata(USER_ID) || $role == BROKER) ? ssn : '' ?>"
                                                   data-type="text"
                                                   data-value="<?php echo $user->ssn ?>"><?php echo $user->ssn == '' ? $user->ssn : "[hidden]" ?></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>D.O.B : </label>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <a href="#"
                                                   id="<?php echo ($user->id == $this->session->userdata(USER_ID) || $role == BROKER) ? dob : '' ?>"
                                                   data-type="date"
                                                   data-value="<?php echo $user->dob ?>">
                                                    <?php echo $user->dob == '' ? $user->dob : "[hidden]" ?></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Phone : </label>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <a href="#" id="phone" data-type="text">
                                                    <?php echo $user->personal_phone ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Fax : </label>
                                            </div>

                                            <div class="form-group col-md-7">
                                                <a href="#" id="fax" data-type="text">
                                                    <?php echo $user->personal_fax ?></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Address : </label>
                                            </div>
                                            <div class="form-group  col-md-7">
                                                <a href="#" id="street" data-type="text"
                                                   data-pk="<?php echo $user->address_id ?>">
                                                    <?php echo $user->street; ?></a>
                                                <br/>
                                                <a href="#" id="city" data-type="text"
                                                   data-pk="<?php echo $user->address_id ?>">
                                                    <?php echo $user->city; ?></a>
                                                <br/>
                                                <a href="#" id="state" data-type="select"
                                                   data-value="<?php echo $user->address_id ?>"
                                                   data-pk="<?php echo $user->address_id; ?>"
                                                   data-source="<?php echo $state ?>"
                                                   data-emptytext="select a state"><?php echo $user->state ?> , </a>
                                                <a href="#" id="postal_code" data-type="text"
                                                   data-pk="<?php echo $user->address_id ?>">
                                                    <?php echo $user->postal_code; ?></a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if (in_array('broker', $roles)) : ?>


                                        <div class="border col-md-6">
                                            <div class="row center" style="padding-left: 90px;">
                                                <span style="text-decoration: underline; font-size: 16px;">Business Information ‎</span><br/>
                                            </div>
                                            <br/>

                                            <div class="row">

                                                <div class="form-group col-md-5">
                                                    <label>Website : </label>
                                                </div>
                                                <div class="form-group col-md-7">
                                                    <a href="#" id="site" data-type="text">
                                                        <?php echo $business->site ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Email : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="b_email" data-type="text">
                                                        <?php echo $business->email; ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Company : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="name" data-type="text">
                                                        <?php echo $business->name ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>D.B.A : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="dba" data-type="text">
                                                        <?php echo $business->dba ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Phone : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="b_phone" data-type="text">
                                                        <?php echo $business->b_phone ?></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Fax : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="b_fax" data-type="text">
                                                        <?php echo $business->b_fax ?></a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Address : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    <a href="#" id="b_street" data-type="text"
                                                       data-pk=<?php echo $business->address_id; ?>>
                                                        <?php echo $business->street; ?></a>
                                                    <br/>
                                                    <a href="#" id="b_city" data-type="text"
                                                       data-pk=<?php echo $business->address_id; ?>>
                                                        <?php echo $business->city; ?></a>
                                                    <br/>
                                                    <a href="#" id="b_state" data-type="select"
                                                       data-value="<?php echo $business->address_id ?>"
                                                       data-pk="<?php echo $business->address_id; ?>"
                                                       data-source="<?php echo $state ?>"
                                                       data-emptytext="select a state"><?php echo $business->state ?>
                                                        , </a>
                                                    <a href="#" id="postal_code" data-type="text"
                                                       data-pk=<?php echo $business->address_id; ?>>
                                                        <?php echo $business->postal_code; ?></a>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-5">
                                                    <label>Commissions : </label>
                                                </div>
                                                <div class="form-group  col-md-7">
                                                    Owner : <a href="#" id="owner_commission" data-type="text">
                                                        <?php echo $business->owner_commission; ?></a>
                                                    <br/>
                                                    Client : <a href="#" id="client_commission" data-type="text">
                                                        <?php echo $business->client_commission; ?></a>
                                                </div>
                                            </div>


                                        </div>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="membershiptab">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Broker : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="broker_id" data-type="select"
                                                   data-value="<?php echo $user->broker_id ?>"
                                                   data-pk=<?php echo singleQuote(array('broker_id' => $user->broker_id, 'client_id' => $user->id)); ?>
                                                   data-source="<?php echo $brokers ?>"
                                                   data-emptytext="select a broker"><?php echo $user->broker_name ?></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Roles :

                                                </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="role_id" data-type="checklist"
                                                   data-value="<?php echo $userRoles[$user->id] ?>"
                                                   email="<?php echo $user->email ?>"
                                                   data-source="<?php echo $roles ?>"> <?php foreach ($userRoles as $role_name){
                                                        echo $role_name . '<br>';
                                                    } ?> </a>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Email : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="email" data-type="text">
                                                    <?php echo $user->email; ?></a>

                                                <div id='duplicate' style="color:red; font-size: 14px;"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Memberships : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <?php echo $brokerMembership[0]->description; ?><br/>
                                                <?php echo $clientMembership[0]->description; ?><br/>
                                                <?php echo $ownerMembership[0]->description; ?><br/>
                                                <?php
                                                if (in_array($role, array(BROKER, ADMIN, CLIENT, OWNER))) {
                                                    if ($userMembership == '') { ?>
                                                        <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipRequest/' . $user->id . '/' . $this->session->userdata(USER_ID)) ?>">
                                                            Send Membership Request
                                                        </a>
                                                    <?php } ?>
                                                    <?php if ($this->uri->segment(4) == $this->userId) : ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade/' . $this->uri->segment(4)); ?>">
                                                        <br/>Upgrade
                                                        Membership</a>
                                                        <?php endif ; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Coupons : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <?php if ($role == 'broker'): ?>
                                                    <?php
                                                    echo anchor('/administrator/campaign', $coupons_details->coupon, array('id' => 'popoverOption', 'data-type' => 'text', 'class' => 'btn', 'rel' => 'popover', 'data-placement' => 'right', 'data-html' => 'true', 'data-content' => ($coupons_details->label . "<br>" . $coupons_details->amount . "<br>" . $coupons_details->percentage))) ?>
                                                <?php else : ?>

                                                    <a href='#' id='popoverOption1' data-type='text' class='btn'
                                                       rel='popover' data-placement='right' data-html='true'
                                                       data-content='<?php echo $coupons_details->label . "<br>" . $coupons_details->amount . "<br>" . $coupons_details->percentage ?>'> <?php echo $coupons_details->coupon ?> </a>


                                                <?php endif ?>
                                            </div>
                                            <script>
                                                $('#popoverOption').popover({trigger: "hover"});
                                                $('#popoverOption1').popover({trigger: "hover"});
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>User Id : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <?php
                                                echo $user->id ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Change Password : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="password" data-type="password"
                                                   type="password"><?php echo ($user->password) == '' ? $user->password : "[hidden]" ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Security Question : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="question_id_1" data-type="select"
                                                   data-value="<?php echo $user->question_id_1 ?>"
                                                   data-pk=<?php echo $user->id; ?>
                                                   data-source="<?php echo '[{value:1,text:\'What was your childhood nickname ?\'},{value:2,text:\'In what city did you meet your spouse significant other ?\'},{value:3,text:\'What is the name of your favourite childhood friend ?\'},{value:4,text:\'What street did you live on in third grade ?\'},{value:5,text:\'What is your oldest siblings birthday month and year ?\'},{value:6,text:\'What is the middle name of your oldest child ?\'},{value:7,text:\'What is your oldest siblings middle name ?\'},{value:8,text:\'What school did you attend for sixth grade ?\'},{value:9,text:\'What was your childhood phone number including area code ?\'},{value:10,text:\'What is your oldest cousin first and last name ?\'}]' ?>"
                                                   data-emptytext="select a question"><?php echo $user->question ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Answer : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="answer_1" data-type="text"
                                                   data-value="<?php echo $user->answer_1 ?>"><?php echo $user->answer_1 == '' ? $user->answer_1 : "[hidden]" ?></a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Security Question : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="question_id_2" data-type="select"
                                                   data-value="<?php echo $user->question_id_2 ?>"
                                                   data-pk=<?php echo $user->id; ?>
                                                   data-source="<?php echo '[{value:11,text:\'What was the name of your first stuffed animal ?\'},{value:12,text:\'In what city did you meet your spouse significant other ?\'},{value:13,text:\'Where were you when you had first kiss ?\'},{value:14,text:\'What is the first name of the boy or girl that you first kissed ?\'},{value:15,text:\'What was the last name of your third grade teacher ?\'},{value:16,text:\'In what city does your nearest sibling live ?\'},{value:17,text:\'What is your oldest brother birthday month and year ?\'},{value:18,text:\'What is your maternal grandmother maiden name ?\'},{value:19,text:\'In what city or town was your first job ?\'},{value:20,text:\'What is the name of the place your wedding reception was held ?\'}]' ?>"
                                                   data-emptytext="select a question"><?php echo $user->question2 ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label>Answer : </label>
                                            </div>
                                            <div class="form-group col-md-7">
                                                <a href="#" id="answer_2" data-type="text"
                                                   data-value="<?php echo $user->answer_2 ?>"><?php echo $user->answer_2 == '' ? $user->answer_2 : "[hidden]" ?></a>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <script>
                $('#member').click(function () {
                    $('#main_content').css('background', 'lightgray');
                    $('#mems').css('background', 'lightgray');
                });

                $('#per').click(function () {

                    $('#main_content').css('background', '#fff');
//                $('#mems').css('background' , '#fff');
                });

            </script>

            <div class="col-md-9" id="emp">
                <div class="nav-tabs-custom transbox">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#employmenttab" data-toggle="tab">Employment</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="employmenttab">

                            <div class="container-fluid">

                                <section class="content-header">
                                    <h1>
                                        <small><a id="addemploy" href="#">Add a new employee detail</a></small>
                                    </h1>
                                </section>

                                <div class="box-body">
                                    <table class="table table-bordered table-striped" id="emplyee">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Company</th>
                                            <th>Street</th>
                                            <th>City</th>
                                            <th>Zip</th>
                                            <th>Website</th>
                                            <th>Position</th>
                                            <th>Yearly Salary</th>
                                            <th>Experience</th>
                                            <th>Phone #</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($employ as $employ) { ?>
                                            <tr class="item">
                                                <td><?php echo $employ->id; ?></td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>" id="company"
                                                       data-type="text"><?php echo($employ->company) ?></a></td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>"
                                                       id="street_employment"
                                                       data-type="text"><?php echo($employ->street_employment) ?></a>
                                                </td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>"
                                                       id="city_employment"
                                                       data-type="text"><?php echo($employ->city_employment) ?></a>
                                                </td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>"
                                                       id="zip_employment"
                                                       data-type="text"><?php echo($employ->zip_employment) ?></a>
                                                </td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>" id="web_address"
                                                       data-type="text"><?php echo($employ->web_address) ?></a></td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>" id="position"
                                                       data-type="text"><?php echo $employ->position; ?></a></td>
                                                <td><a href="#" id="salary"
                                                       data-value="<?php echo '$' . $employ->salary ?>"
                                                       data-pk=<?php echo $employ->id; ?><?php echo '$' . $employ->salary ?></a>
                                                </td>
                                                <td><a href="#" id="years" data-type="select"
                                                       data-value="<?php echo $employ->years ?>"
                                                       data-pk=<?php echo $employ->id; ?> data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12},{value:13,text:13},{value:14,text:14},{value:15,text:15},{value:16,text:16},{value:17,text:17},{value:18,text:18},{value:19,text:19},{value:20,text:20}]' ?>"
                                                       data-emptytext="years"><?php echo $employ->years ?></a>
                                                    YRS
                                                    <a href="#" id="months" data-type="select"
                                                       data-value="<?php echo $employ->months ?>"
                                                       data-pk=<?php echo $employ->id; ?>
                                                       data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12}]' ?>"
                                                       data-emptytext="months"><?php echo $employ->months ?></a>
                                                    MO
                                                </td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>"
                                                       id="phone_employment"
                                                       data-type="text"><?php echo $employ->phone_employment; ?></a>
                                                </td>
                                                <td><a href="#" data-pk="<?php echo $employ->id ?>"
                                                       id="comment_employment"
                                                       data-type="text"><?php echo $employ->comment_employment; ?></a>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                       onclick="return confirm('Are you sure you want to delete?')? deleteEmployment(<?php echo $employ->id . ',' . $employ->user_id ?>): '';"><span
                                                            class="glyphicon glyphicon-trash"></span></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal fade" id="employment" tabindex="-1" role="dialog"
                                     aria-labelledby="employment" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" id="employ_modal">
                                            <form
                                                action="<?php echo base_url() . 'administrator/employment/addEmployment'; ?>"
                                                method="post"
                                                id="addemploye">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="employment">Add a new Employement
                                                        Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="box box-danger">
                                                            <div class="box-body">
                                                                <div class="form-group col-md-7">
                                                                    <label class="left">Employer:</label>
                                                                    <input type='text' class="form-control"
                                                                           id="company1"
                                                                           name="company1"/>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label class="left">Position:</label>
                                                                    <input type='text' class="form-control"
                                                                           id="position1"
                                                                           name="position1"/>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label class="control-label" for="sal">Yearly
                                                                        Salary:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-dollar"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="sal"
                                                                               name="sal"/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-7">
                                                                    <label for="phone">Phone number:</label>

                                                                    <div class="input-group">
                                                                        <div class="input-group-addon"><i
                                                                                class="fa fa-phone"></i></div>
                                                                        <input type="text" class="form-control"
                                                                               id="phone1" name="phone1"
                                                                               data-mask="(999) 999-9999"
                                                                               placeholder="(999) 999-9999"/>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group col-md-12">
                                                                    <label style="padding-left: 15px;">How long did
                                                                        you
                                                                        work
                                                                        here?</label>
                                                                    </br>


                                                                    <div class='form-group col-md-3'>
                                                                        <label for="experienced">Year</label>
                                                                        <?php
                                                                        $option = array(
                                                                            '' => 'Year',
                                                                            '1' => '1',
                                                                            '2' => '2',
                                                                            '3' => '3',
                                                                            '4' => '4',
                                                                            '5' => '5',
                                                                            '6' => '6',
                                                                            '7' => '7',
                                                                            '8' => '8',
                                                                            '9' => '9',
                                                                            '10' => '10',
                                                                            '11' => '11',
                                                                            '12' => '12',
                                                                            '13' => '13',
                                                                            '14' => '14',
                                                                            '15' => '15',
                                                                            '16' => '16',
                                                                            '17' => '17',
                                                                            '18' => '18',
                                                                            '19' => '19',
                                                                            '20' => '20'
                                                                        );

                                                                        echo form_dropdown('years', $option, '', array('class' => 'form-control ', 'id' => 'year')) ?>
                                                                    </div>


                                                                    <div class='form-group col-md-3'>
                                                                        <label for="experienced">Month</label>
                                                                        <?php
                                                                        $option = array(
                                                                            '' => 'Month',
                                                                            '1' => '1',
                                                                            '2' => '2',
                                                                            '3' => '3',
                                                                            '4' => '4',
                                                                            '5' => '5',
                                                                            '6' => '6',
                                                                            '7' => '7',
                                                                            '8' => '8',
                                                                            '9' => '9',
                                                                            '10' => '10',
                                                                            '11' => '11',
                                                                            '12' => '12',
                                                                        );

                                                                        echo form_dropdown('months', $option, '', array('class' => 'form-control ', 'id' => 'month')) ?>
                                                                    </div>

                                                                    <div class="form-group col-md-7">
                                                                        <label for="Street1">Street:</label>
                                                                        <input data-type="text" class="form-control"
                                                                               id="street1"
                                                                               name="street1"/>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-7">
                                                                    <label for="city1">City:</label>
                                                                    <input data-type="text" class="form-control"
                                                                           id="city1"
                                                                           name="city1"/>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label for="zip1">Zip Code:</label>
                                                                    <input data-type="text" class="form-control"
                                                                           id="zip1"
                                                                           name="zip1"/>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label for="web_address2">Web Address:</label>
                                                                    <input data-type="text" class="form-control"
                                                                           id="web_address2"
                                                                           name="web_address2"/>
                                                                </div>
                                                                <div class="form-group col-md-7">
                                                                    <label for="comment1">Comment:</label>
                                                                    <input data-type="text" class="form-control"
                                                                           id="comment1"
                                                                           name="comment1"/>
                                                                </div>
                                                                <input type="hidden" class="form-control"
                                                                       id="user_id"
                                                                       name="user_id"
                                                                       value="<?php echo $this->uri->segment(4); ?>"/>
                                                                <input type="hidden" class="form-control" id="type"
                                                                       name="protype"
                                                                       value="<?php echo $protype; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Add Employee
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>

                                    $(document).on("focus", "#sal", function () {
                                        $(this).mask("000,000,000,000,000", {reverse: true});
                                    });

                                    $(document).on("focus", ".salarymask", function () {
                                        $(this).mask("000,000,000,000,000", {reverse: true});
                                    });

                                    $(document).on("focus", ".zipmask", function () {
                                        $(this).mask("00000");
                                    });

                                    $(document).on("focus", "#zip1", function () {
                                        $(this).mask("00000");
                                    });

                                    $(document).on("focus", ".phonemask", function () {
                                        $(this).mask("(000) 000-0000");
                                    });

                                    $(document).on("focus", ".webmask", function () {
                                        $(this).mask("http://");
                                    });

                                    function deleteEmployment(id, userid) {
                                        $.post("<?php echo base_url() . 'administrator/employment/deleteEmployment'; ?>", {
                                                id: id,
                                                user_id: userid
                                            })
                                            .success(function (data) {
                                                try {
                                                    var data1 = $.parseJSON(data);
                                                    if (data1.message) {
                                                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                                                    } else {
                                                        location.reload();
                                                    }
                                                } catch (e) {
                                                    location.reload();
                                                }
                                            });
                                    }

                                    $('#company*,#position*,#street_employment*,#url*,#comment_employment*').editable({

                                        pk: '<?php echo $employ->id;?>',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') {
                                                return response.msg;
                                            }
                                            location.reload();
                                        }
                                    });

                                    $('#city_employment*').editable({
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        tpl: '<input type="text" title="Only Alphabet" pattern="^[a-zA-Z\s]+$" style="padding-right: 24px;">',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') return response.msg;
                                            location.reload();
                                        }
                                    });

                                    $('#phone_employment*').editable({
                                        placement: 'right',
                                        pk: '<?php echo $employ->id;?>',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        tpl: '<input type="text"   class="phonemask"  style="padding-right: 24px;">',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') return response.msg;
                                            location.reload();
                                        }
                                    });

                                    $('#web_address*').editable({
                                        placement: 'right',
                                        pk: '<?php echo $employ->id;?>',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        tpl: '<input type="text"   class=""  style="padding-right: 24px;">',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') return response.msg;
                                            location.reload();
                                        }
                                    });

                                    $('#zip_employment*').editable({
                                        placement: 'right',
                                        pk: '<?php echo $employ->id;?>',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        tpl: '<input type="text"   class="zipmask"   style="padding-right: 24px;">',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') return response.msg;
                                            location.reload();
                                        }
                                    });

                                    $('#salary*').editable({
                                        placement: 'right',
                                        pk: '<?php echo $employ->id;?>',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',
                                        tpl: '<input type="text" class="salarymask"   style="padding-right: 24px;">',
                                        params: function (params) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') return response.msg;
                                            location.reload();
                                        }
                                    });

                                    $('#months*,#years*').editable({
                                        placement: 'right',
                                        url: '<?php echo base_url() . 'administrator/post'; ?>',

                                        params: function (params, newValue) {
                                            params.table = 'employment';
                                            return params;
                                        },
                                        success: function (response, newValue) {
                                            if (response.status == 'error') {
                                                return response.msg;
                                            }
                                            location.reload();
                                        }
                                    });

                                    $("#addemploy").click(function () {
                                        $("#employment").modal();
                                        return false;
                                    });

                                    $("#addemploye").formValidation({
                                        message: 'This value is not valid',
                                        fields: {
                                            company1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Enter Company'
                                                    },
                                                    blank: {}
                                                }
                                            }, join1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Enter Date Of Joining Company '
                                                    },
                                                    blank: {}
                                                }
                                            }, position1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Enter Position At Work'
                                                    },
                                                    regexp: {
                                                        regexp: /^[a-z\d\-_\s]+$/i

                                                    },
                                                    blank: {}
                                                }
                                            }, sal: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Enter Salary Amount'
                                                    },
                                                    regexp: {
                                                        regexp: /[0-9]+(,[0-9]+)*,?/

                                                    },
                                                    blank: {}
                                                }
                                            }, phone1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Phone no. is required'
                                                    },
                                                    stringLength: {
                                                        min: 10,
                                                        message: 'Must be of Length 10'
                                                    },
                                                    blank: {}
                                                }
                                            }, city1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Required'
                                                    },
                                                    blank: {}
                                                }
                                            }, street1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Required'
                                                    },
                                                    blank: {}
                                                }
                                            }, zip1: {
                                                validators: {
                                                    notEmpty: {
                                                        message: 'Required'
                                                    },
                                                    stringLength: {
                                                        min: 5,
                                                        message: 'Must be of Length 5'
                                                    },

                                                    blank: {}
                                                }
                                            },
                                            web_address2: {
                                                validators: {
                                                    optional: true,
                                                    uri: {
                                                        message: 'Invalid'
                                                    }
                                                }
                                            }
                                        }


                                    });
                                </script>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-9" id="app">
                <div class="nav-tabs-custom transbox">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#application" data-toggle="tab">Credit Application</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="application">
                            <div class="container-fluid">

                                <section class="content-header">
                                    <h1>
                                        <small><a id="addcredit" <a href="#">Add a new credit application
                                                details</a>
                                        </small>
                                    </h1>

                                </section>
                            </div>

                            <div class="box-body">
                                <table class="table table-bordered table-striped" id="emplyee">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Creditor</th>
                                        <th>Type</th>
                                        <th>Application Date</th>
                                        <th>Line Of Credit</th>
                                        <th>Status</th>
                                        <?php if ($credit->status == '1') {
                                            ?>
                                            <th>Due Day</th>
                                        <?php } ?>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($credit as $credit) { ?>
                                        <tr class="item">
                                            <td><?php echo $credit->id; ?></td>

                                            <td><a href="#" id="creditor"
                                                   data-value="<?php echo $credit->creditor ?>"
                                                   data-pk=<?php echo $credit->id; ?><?php echo $credit->creditor; ?></a>
                                            </td>
                                            <td><a href="#" id="application_type" data-type="select"
                                                   data-value="<?php echo $credit->application_type ?>"
                                                   data-pk=<?php echo $credit->id; ?>
                                                   data-source="<?php echo '[{value:\'credit_card\',text:\'Credit card\'},{value:\'auto\',text:\'Auto\'}, {value:\'mortgage\',text:\'Mortgage\'},{value:\'furniture\',text:\'Furniture\'},{value:\'others\',text:\'Others\'}]' ?>"
                                                   data-emptytext="Select Credit Type"><?php if ($credit->application_type == 'credit_card') echo 'Credit Card';
                                                    elseif ($credit->application_type == 'auto') echo 'Auto';
                                                    elseif ($credit->application_type == 'mortgage') echo 'Mortgage';
                                                    elseif ($credit->application_type == 'furniture') echo 'Furniture';
                                                    elseif ($credit->application_type == 'others') echo 'Others'; ?></a>
                                            </td>
                                            <?php
                                            $dbDate = $credit->applied;
                                            $convertDate = new DateTime($dbDate);
                                            $standard_date = $convertDate->format('m/d/y');
                                            ?>
                                            <td><a href="#" data-pk="<?php echo $credit->id ?>" id="applied"
                                                   data-type="date"><?php echo $standard_date; ?></a></td>
                                            <td><a href="#" id="amount"
                                                   data-value="<?php echo '$' . $credit->amount ?>"
                                                   data-pk=<?php echo $credit->id; ?><?php echo '$' . $credit->amount ?></a>
                                            </td>
                                            <td><a href="#" id="status" data-type="select"
                                                   data-value="<?php echo $credit->status ?>"
                                                   data-pk=<?php echo $credit->id; ?>
                                                   data-source="<?php echo '[{value:0,text:\'Rejected\'},{value:1,text:\'Approved\'}]' ?>"
                                                   data-emptytext="Select Status"><?php echo $credit->status == '0' ? 'Rejected' : 'Approved' ?>
                                            </td>
                                            <?php if ($credit->status == '1') {
                                                ?>
                                                <td><a href="#" data-pk="<?php echo $credit->id ?>" id="due"
                                                       data-type="text"><?php echo $credit->due; ?></a></td>
                                            <?php } else { ?>


                                                <td><a href="#" data-pk="#"
                                                       data-type="text"></a></td>
                                            <?php } ?>
                                            <td><a href="#" data-pk="<?php echo $credit->id ?>"
                                                   id="comment_application"
                                                   data-type="text"><?php echo $credit->comment_application; ?></a>
                                            </td>
                                            <td>
                                                <a href="#"
                                                   onclick="return confirm('Are you sure you want to delete?')? deleteCredit(<?php echo $credit->id . ',' . $credit->user_id ?>): '';"><span
                                                        class="glyphicon glyphicon-trash"></span></i></a>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="credit" tabindex="-1" role="dialog"
                                 aria-labelledby="credit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form
                                            action="<?php echo base_url() . 'administrator/application/addCreditApplication'; ?>"
                                            method="post"
                                            id="credite">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span
                                                        aria-hidden="true">&times;</span><span
                                                        class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="credit1">Add A New Credit
                                                    Application</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="box box-danger">
                                                        <div class="box-body">
                                                            <div class="form-group col-md-7">
                                                                <label class="left">Creditor:</label>
                                                                <input type='text' class="form-control"
                                                                       id="creditor1"
                                                                       name="creditor1"/>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label class="left">Type:</label>
                                                                <?php
                                                                $type = array(
                                                                    'credit_card' => 'Credit Card',
                                                                    'auto' => 'Auto',
                                                                    'mortgage' => 'Mortgage',
                                                                    'furniture' => 'Furniture',
                                                                    'others' => 'Others'
                                                                );
                                                                echo form_dropdown('type1', $type, '', array('class' => 'form-control', 'name' => 'type1')) ?>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label for="join">Application Date:</label>

                                                                <div class='input-group date'>
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input data-type="text"
                                                                           class="form-control date-picker "
                                                                           id="applied1"
                                                                           name="applied1"
                                                                           data-mask="00/00/0000"
                                                                           placeholder="MM/DD/YYYY"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label class="control-label" for="sal">Line Of
                                                                    Credit:</label>

                                                                <div class="input-group">
                                                                    <div class="input-group-addon"><i
                                                                            class="fa fa-dollar"></i></div>
                                                                    <input type="text" class="form-control"
                                                                           id="amount1"
                                                                           name="amount1"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label class="control-label"
                                                                       for="sal">Status:</label>
                                                                <?php
                                                                $status = array(
                                                                    '0' => 'Rejected',
                                                                    '1' => 'Approved'
                                                                );
                                                                echo form_dropdown('status1', $status, '1', array('class' => 'form-control', 'id' => 'status1')) ?>
                                                            </div>
                                                            <div class="form-group col-md-7" id="due_day">
                                                                <label for="join">Due Day:</label>

                                                                <div class='input-group date'>
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <input data-type="text" class="form-control"
                                                                           id="due1"
                                                                           name="due1" data-mask="00"
                                                                           placeholder="DD"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-7">
                                                                <label for="comment4">Comment:</label>
                                                                <input data-type="text" class="form-control"
                                                                       id="comment4"
                                                                       name="comment4"/>
                                                            </div>
                                                            <input type="hidden" class="form-control"
                                                                   id="user_id"
                                                                   name="user_id"
                                                                   value="<?php echo $this->uri->segment(4); ?>"/>
                                                            <input type="hidden" class="form-control" id="type"
                                                                   name="protype"
                                                                   value="<?php echo $protype; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Add Credit
                                                    Application
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                jQuery('#status1').change(function () {
                                    if ($(this).val() == 0) {
                                        $('#due_day').hide();
                                    }
                                    else {
                                        $('#due_day').show();

                                    }
                                });

                                $(document).on("focus", "#amount1", function () {
                                    $(this).mask("000,000,000,000,000", {reverse: true});
                                });

                                $(document).on("focus", ".amountmask", function () {
                                    $(this).mask("000,000,000,000,000", {reverse: true});
                                });


                                $("#applied1").datepicker({maxDate: 0});

                                $(document).on("focus", ".day", function () {
                                    $(this).mask("00");
                                });

                                function deleteCredit(id, userid) {
                                    $.post("<?php echo base_url() . 'administrator/application/deleteCreditApplication'; ?>", {
                                            id: id,
                                            user_id: userid
                                        })
                                        .success(function (data) {
                                            try {
                                                var data1 = $.parseJSON(data);
                                                if (data1.message) {
                                                    $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                                                } else {
                                                    location.reload();
                                                }
                                            } catch (e) {
                                                location.reload();
                                            }
                                        });
                                }

                                $('#creditor,#applied,#application_type,#status,#comment_application').editable({
                                    placement: 'right',
                                    url: '<?php echo base_url() . 'administrator/post'; ?>',
                                    params: function (params) {
                                        params.table = 'application';
                                        return params;
                                    },
                                    success: function (response, newValue) {
                                        if (response.status == 'error') {
                                            return response.msg;
                                        }
                                        location.reload();
                                    }
                                });


                                $('#due*').editable({
                                    placement: 'right',
                                    url: '<?php echo base_url() . 'administrator/post'; ?>',
                                    tpl: '<input type="text" class="day" placeholder="DD">',
                                    params: function (params) {
                                        params.table = 'application';
                                        return params;
                                    },
                                    success: function (response, newValue) {
                                        if (response.status == 'error') {
                                            return response.msg;
                                        }
                                        location.reload();
                                    }
                                });

                                $('#amount*').editable({
                                    placement: 'right',
                                    url: '<?php echo base_url() . 'administrator/post'; ?>',
                                    tpl: '<input type="text" class="amountmask" >',
                                    params: function (params) {
                                        params.table = 'application';
                                        return params;
                                    },
                                    success: function (response, newValue) {
                                        if (response.status == 'error') {
                                            return response.msg;
                                        }
                                        location.reload();
                                    }

                                });

                                $("#addcredit").click(function () {
                                    $("#credit").modal();
                                    return false;
                                });


                                $("#credite").formValidation({
                                    message: 'This value is not valid',
                                    fields: {
                                        creditor1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                blank: {}
                                            }
                                        }, applied1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                blank: {}
                                            }
                                        }, due1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                between: {
                                                    min: 1,
                                                    max: 31,
                                                    message: 'Not Valid'
                                                },
                                                blank: {}
                                            }
                                        }, amount1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                regexp: {
                                                    regexp: /^\s*(\d+(\s*,\s*\d+)*)?\s*$/
                                                },
                                                blank: {}
                                            }
                                        }, type1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                blank: {}
                                            }
                                        }, status1: {
                                            validators: {
                                                notEmpty: {
                                                    message: 'Required'
                                                },
                                                blank: {}
                                            }
                                        }
                                    }

                                });

                                $(".date-picker").on('changeDate', function (e) {
                                    $('#credite').formValidation('revalidateField', 'applied1');
                                });


                            </script>
                        </div>


                    </div>
                </div>
            </div>
    </section>
</div>

<script>

    $("#img").click(function () {
        $('#profile_image').css('display', 'block');
    });

    jQuery('#status1').change(function () {
        if ($(this).val() == 0) {
            $('#due_day').hide();
        }
        else {
            $('#due_day').show();

        }
    });

    $(document).on("focus", "#sal,#amount1", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });

    $(document).on("focus", ".salarymask,.amountmask", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });

    $(document).on("focus", ".zipmask,.postalmask", function () {
        $(this).mask("00000");
    });

    $(document).on("focus", "#zip1", function () {
        $(this).mask("00000");
    });

    $(document).on("focus", ".phonemask,.faxmask,.phone_employmentmask,.b_phone,.b_fax", function () {
        $(this).mask("(000) 000-0000");
    });

    $('#salary*').editable({
        placement: 'right',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="salarymask"   style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#zip_employment*').editable({
        placement: 'right',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="zipmask"   style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#postal_code*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="postalmask"   style="padding-right: 24px;">',
        placeholder: 'enter zip code',
        params: function (params) {
            params.table = 'address';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload(true);
        }
    });

    $('#phone_employment*').editable({
        placement: 'left',
        pk: '<?php echo $employ->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="phone_employmentmask" title="(xxx) xxx-xxxx" pattern="\d{3}\d{}\d{3}\-\d{4}" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#phone*').editable({
        placement: 'right',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="phonemask"  style="padding-right: 24px;">',
        placeholder: 'enter phone',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#b_phone*').editable({
        placement: 'top',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="b_phone"  style="padding-right: 24px;">',
        placeholder: 'enter phone',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#b_fax*').editable({
        placement: 'top',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="b_fax"  style="padding-right: 24px;">',
        placeholder: 'enter fax',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#fax*').editable({
        placement: 'right',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="faxmask"  style="padding-right: 24px;">',
        placeholder: 'enter fax',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });

    $('#amount*').editable({
        placement: 'left',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="amountmask" >',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }

    });

    $('#due*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="day" placeholder="DD">',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("focus", ".day", function () {
        $(this).mask("00");
    });


    $("#applied1").datepicker({maxDate: 0});
    $("#applied").datepicker();

    $.fn.editable.defaults.mode = 'popup';

    $('#first_name').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter first name',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#last_name').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter last name',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#comment').editable({
        placement: 'right',
        container: 'body',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'write comment',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#gender').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'choose gender',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#middle_initial').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  class="maskOneLetter form-control input-sm dd" style="padding-right: 24px;">',
        placeholder: 'enter middle initial',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#ssn').editable({

        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  class="mask form-control input-sm dd" style="padding-right: 24px;">',
        placeholder: 'enter social',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });
    $('#email').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  pattern="^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$" style="padding-right: 24px;">',
        placeholder: 'enter email',
        params: function (params) {
            params.table = 'user';
            return params;
        },
        success: function (response, newValue) {
            $('#duplicate').remove();
            if (response.status == 'error') return response.msg;

        },
        error: function () {
            $("#duplicate").append("This email has been already registered ! Please try another.");
        }
    });

    $('#b_email').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  pattern="^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$" style="padding-right: 24px;">',
        placeholder: 'enter business email',
        params: function (params) {
            params.table = 'business';
            params.name = 'email';
            return params;
        },
        success: function (response, newValue) {
            $('#duplicate').remove();
            if (response.status == 'error') return response.msg;

        },
        error: function () {
            $("#duplicate").append("This email has been already registered ! Please try another.");
        }
    });

    $('#password').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter password',
        params: function (params) {
            params.table = 'user';
            if (params.value)
                params.value = CryptoJS.MD5(params.value).toString();
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#site').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter website',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#name').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter business name',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#dba').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter dba',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#b_phone').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter phone number',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#b_fax').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter fax number',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#owner_commission').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter owner comission',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#client_commission').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter broker comission',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


    $('#street, #b_street').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter street',
        params: function (params) {
            params.table = 'address';
            params.name = 'street';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg
            } else {
                //proper way to reload the div... however need some work
//                $('#personal_map', window.parent.document).attr('src', $('#personal_map', window.parent.document).attr('src'));
            }
        }
    });


    $('#city, #b_city').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
//        tpl: '<input type="text"  title="Only Alphabet" pattern="^[a-zA-Z\s]+$" style="padding-right: 24px;">',
        placeholder: 'enter city',
        params: function (params) {
            params.table = 'address';
            params.name = 'city';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });


    $('#city_employment*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" title="Only Alphabet" pattern="^[a-zA-Z\s]+$" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });


    $('#dob').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placeholder: 'enter dob',
        placement: 'left',
        params: function (params) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });
    $('#applied*').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
        }
    });


    $('#role_id').editable({
        pk: <?php echo json_encode(array('role_id' => $user_roles[$user->id], 'user_id' => $user->id)); ?>,
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'user_role';
            params.deleteKey = 'user_id';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            } else {
                $.ajax({
                    url: "<?php echo base_url().'/administrator/home/changeRoles/'?>",
                    method: "POST",
                    data: {'email': $(this).attr('email')}
                }).done(function (data) {
                    populateDropdown(data, '.roles');
                });
            }
        }
    });


    $("#type").click(function () {
        alert("Handler for .click() called.");
    });

    $('#type*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'membership';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });


    //    $('#status*').editable({
    //        url: '<?php //echo base_url() . 'administrator/post'; ?>//',
    //        params: function (params) {
    //            params.table = 'user';
    //            return params;
    //        },
    //        success: function (response, newValue) {
    //            if (response.status == 'error') {
    //                return response.msg;
    //            }
    //        }
    //    });

    $('#campaign').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'membership';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#broker_id').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        prepend: "Unassigned",
        params: function (params, newValue) {
            params.table = 'broker';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#state, #b_state').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params, newValue) {
            params.table = 'address';
            params.name = 'state';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#company,#position,#street_employment,#url,#comment_employment,#web_address').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


    $("#addemploy").click(function () {
        $("#employment").modal();
        $('#app').fadeOut(2500);


        $('#employment').on('hidden.bs.modal', function () {
            $('#app').fadeIn(0.1);
        })


        return false;
    });

    $('#creditor,#amount,#comment_application').editable({
        placement: 'left',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $("#addcredit").click(function () {
        $("#credit").modal();
        return false;
    });


    $(document).on("focus", ".mask", function () {
        $(this).mask("999-99-9999");
    });

    $(document).on("focus", ".maskOneLetter", function () {
        $(this).mask("A");
    });


    $('#application_type*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });
    $('#status*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $('#question_id_1*,#question_id_2*').editable({

        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#answer_1*,#answer_2*').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'profile';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#months*,#years*').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'employment';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    $('#note*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',

        params: function (params, newValue) {
            params.table = 'notes';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    function deleteCreditApplication(id, userid) {
        $.post("<?php echo base_url() . 'administrator/application/deleteCreditApplication'; ?>", {
                id: id,
                user_id: userid
            })
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    function deleteEmployment(id, userid) {
        $.post("<?php echo base_url() . 'administrator/employment/deleteEmployment'; ?>", {id: id, user_id: userid})
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    function deleteNote(id, userid) {
        $.post("<?php echo base_url() . 'administrator/user/deleteNote'; ?>", {id: id, userId: userid})
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }


    $("#addemploye").formValidation({
        message: 'This value is not valid',
        fields: {
            company1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Company'
                    },
                    blank: {}
                }
            }, join1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Date Of Joining Company '
                    },
                    blank: {}
                }
            }, position1: {
                validators: {
                    notEmpty: {
                        message: 'Enter Position At Work'
                    },
                    regexp: {
                        regexp: /^[a-z\d\-_\s]+$/i

                    },
                    blank: {}
                }
            }, sal: {
                validators: {
                    notEmpty: {
                        message: 'Sample TextEnter Salary Amount'
                    },
                    regexp: {
                        regexp: /[0-9]+(,[0-9]+)*,?/

                    },
                    blank: {}
                }
            }, phone1: {
                validators: {
                    notEmpty: {
                        message: 'Phone no. is required'
                    },
                    stringLength: {
                        min: 10,
                        message: 'Must be of Length 10'
                    },
                    blank: {}
                }
            }, city1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/

                    },
                    blank: {}
                }
            }, street1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, zip1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    stringLength: {
                        min: 5,
                        message: 'Must be of Length 5'
                    },
                    blank: {}
                }
            }
        }


    });

    $("#addnote").formValidation({
        message: 'This value is not valid',
        fields: {
            note_validate: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }

        }

    });


    $("#credite").formValidation({
        message: 'This value is not valid',
        fields: {
            creditor1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, applied1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, due1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    between: {
                        min: 1,
                        max: 31,
                        message: 'Not Valid'
                    },
                    blank: {}
                }
            }, amount1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^\s*(\d+(\s*,\s*\d+)*)?\s*$/
                    },
                    blank: {}
                }
            }, status1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }

    });


    $(document).ready(
        function () {
            $('input:file').change(
                function () {
                    if ($(this).val()) {
                        $('input:submit').attr('disabled', false);
                    }
                }
            );
        }
    );

    if ($(".roles").find("option:selected").val() == 'client') {
        $('#role_id').editable('toggleDisabled');
        $('#campaign').editable('toggleDisabled');
    }
    if ($(".roles").find("option:selected").val() == 'broker') {
        $('#role_id').editable('toggleDisabled');
    }

    $("#upgrade").click(function () {
        $("#upgradeMembership").modal();
        return false;
    });


</script>