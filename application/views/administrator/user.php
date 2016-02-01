<style>
    #applied1 {
        z-index: 1051 !important;
    }

    #due1 {
        z-index: 1051 !important;
    }
</style>

<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $user->first_name . ' ' . $user->last_name ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <?php if ($role == BROKER or $role == SUPER_ADMIN): ?>
                <li><a href="<?php echo base_url() . 'administrator/user'; ?>">Users</a></li>
            <?php endif ?>
            <li class="active">Edit</li>
        </ol>
    </section>

    <section class="content ">
        <div class="row">
            <?php if ($protype == 'general' || ($protype == '')) { ?>
                <section class="col-lg-7 connectedSortable ui-sortable">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Personal</h3>
                            </div>
                            <div class="box-body">
                                <?php if ($this->session->flashdata('message')) { ?>
                                    <div class="alert alert-success">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <?php echo $this->session->flashdata('message'); ?>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="form-group col-md-6"> <?php echo form_label('User Id : ', 'id'); ?>
                                        <?php
                                        echo $user->id ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo form_label('Change Password : ', 'password'); ?>
                                        <a href="#" id="password" data-type="password"
                                           type="password"><?php echo ($user->password) == '' ? $user->password : "[hidden]" ?></a>
                                    </div>
                                    <div
                                        class="form-group col-md-9"> <?php echo form_label('Security Question : ', 'question_id_1'); ?>
                                        <a href="#" id="question_id_1" data-type="select"
                                           data-value="<?php echo $user->question_id_1 ?>"
                                           data-pk=<?php echo $user->id; ?>
                                           data-source="<?php echo '[{value:1,text:\'What was your childhood nickname ?\'},{value:2,text:\'In what city did you meet your spouse significant other ?\'},{value:3,text:\'What is the name of your favourite childhood friend ?\'},{value:4,text:\'What street did you live on in third grade ?\'},{value:5,text:\'What is your oldest siblings birthday month and year ?\'},{value:6,text:\'What is the middle name of your oldest child ?\'},{value:7,text:\'What is your oldest siblings middle name ?\'},{value:8,text:\'What school did you attend for sixth grade ?\'},{value:9,text:\'What was your childhood phone number including area code ?\'},{value:10,text:\'What is your oldest cousin first and last name ?\'}]' ?>"
                                           data-emptytext="select a question"><?php echo $user->question ?></a>
                                    </div>
                                    <div
                                        class="form-group col-md-3"> <?php echo form_label('Answer : ', 'answer_1'); ?>
                                        <a href="#" id="answer_1" data-type="text"
                                           data-value="<?php echo $user->answer_1 ?>"><?php echo $user->answer_1 == '' ? $user->answer_1 : "[hidden]" ?></a>

                                    </div>


                                    <div
                                        class="form-group col-md-9"> <?php echo form_label('Security Question : ', 'question_id_2'); ?>
                                        <a href="#" id="question_id_2" data-type="select"
                                           data-value="<?php echo $user->question_id_2 ?>"
                                           data-pk=<?php echo $user->id; ?>
                                           data-source="<?php echo '[{value:11,text:\'What was the name of your first stuffed animal ?\'},{value:12,text:\'In what city did you meet your spouse significant other ?\'},{value:13,text:\'Where were you when you had first kiss ?\'},{value:14,text:\'What is the first name of the boy or girl that you first kissed ?\'},{value:15,text:\'What was the last name of your third grade teacher ?\'},{value:16,text:\'In what city does your nearest sibling live ?\'},{value:17,text:\'What is your oldest brother birthday month and year ?\'},{value:18,text:\'What is your maternal grandmother maiden name ?\'},{value:19,text:\'In what city or town was your first job ?\'},{value:20,text:\'What is the name of the place your wedding reception was held ?\'}]' ?>"
                                           data-emptytext="select a question"><?php echo $user->question2 ?></a>
                                    </div>
                                    <div
                                        class="form-group col-md-3"> <?php echo form_label('Answer : ', 'answer_2'); ?>
                                        <a href="#" id="answer_2" data-type="text"
                                           data-value="<?php echo $user->answer_2 ?>"><?php echo $user->answer_2 == '' ? $user->answer_2 : "[hidden]" ?></a>

                                    </div>


                                    <!--                                    --><?php //if ($role == 'broker'): ?>
                                    <!--                                        <div class="form-group col-md-3">-->
                                    <!--                                            <label>Verified Balance</label>-->
                                    <!--                                            <a href="#" id="due" data-type="due"-->
                                    <!--                                               type="password">-->
                                    <?php //echo $verified ?><!--</a>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="form-group col-md-3">-->
                                    <!--                                            <label>Unverified Balance</label>-->
                                    <!--                                            <a href="#" id="due" data-type="due"-->
                                    <!--                                               type="password">-->
                                    <?php //echo $unverified ?><!--</a>-->
                                    <!--                                        </div>-->
                                    <!--                                    --><?php //endif ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo form_label('Broker : ', 'broker_id'); ?>
                                        <a href="#" id="broker_id" data-type="select"
                                           data-value="<?php echo $user->broker_id ?>"
                                           data-pk=<?php echo singleQuote(array('broker_id' => $user->broker_id, 'client_id' => $user->id)); ?>
                                           data-source="<?php echo $brokers ?>"
                                           data-emptytext="select a broker"><?php echo $user->broker_name ?></a>
                                    </div>


                                    <!--                                    <div class="form-group col-md-6">-->
                                    <!--                                        --><?php //echo form_label('Status : ', 'status'); ?>
                                    <!--                                        <a href="#" id="status" data-type="select"-->
                                    <!--                                           data-value="-->
                                    <?php //echo $user->status ?><!--"-->
                                    <!--                                           data-pk="-->
                                    <?php //echo $user->id; ?><!--"-->
                                    <!--                                           data-source="[ {value: 0, text: 'inactive'}, {value: 1, text: 'active'}]"-->
                                    <!--                                           data-emptytext="select a status">-->
                                    <?php //echo ($user->status == 1) ? 'active' : 'inactive'; ?><!--</a>-->
                                    <!--                                    </div>-->


                                    <div class="form-group col-md-6">
                                        <div class="form-group">
                                            <?php echo form_label('Roles : ', 'roles'); ?><br/>
                                            <a href="#" id="role_id" data-type="checklist"
                                               data-value="<?php echo $user_roles[$user->id] ?>"
                                               email="<?php echo $user->email ?>"
                                               data-source="<?php echo $roles ?>"></a>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <?php echo form_label('Email : ', 'email'); ?>
                                        <a href="#" id="email" data-type="text">
                                            <?php echo $user->email; ?></a>

                                        <div id='duplicate' style="color:red; font-size: 14px;"></div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="form-group col-md-8">

                                        <div class="form-group">
                                            <?php echo form_label('Memberships : ', 'memberships'); ?>
                                            <?php echo $userMembership ?><br>
                                            <?php if ($role == 'client') { ?>
                                                <a data-toggle="modal"
                                                   href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade') ?>"
                                                   data-target="#membershipUpgrade">
                                                    Upgrade Membership
                                                </a>
                                            <?php }
                                            if (in_array($role, array(BROKER, ADMIN))) {
                                                if ($userMembership == '') { ?>
                                                    <a href="<?php echo site_url(ADMIN_PATH . 'user/membershipRequest/' . $user->id . '/' . $this->session->userdata(USER_ID)) ?>">
                                                        Send Membership Request
                                                    </a>
                                                <?php } else { ?>
                                                    <a data-toggle="modal"
                                                       href="<?php echo site_url(ADMIN_PATH . 'user/membershipUpgrade') ?>"
                                                       data-target="#membershipUpgrade">
                                                        Upgrade Membership
                                                    </a>
                                                <?php }
                                            } ?>

                                            <!--                                            <a href="#" data-type="radiolist" id="type" class="clientMembership"-->
                                            <!--                                               data-value="-->
                                            <?php //echo $clientMembership ?><!--"-->
                                            <!--                                               data-source="-->
                                            <?php //echo $clientMemberships ?><!--"-->
                                            <!--                                               data-pk="-->
                                            <?php //echo singleQuote(array('user_id' => $user->id, 'type' => $clientMembership)); ?><!--">-->
                                            <!--                                            </a>-->
                                            <!--                                            <br/>-->
                                            <!--                                            <a href="#" data-type="radiolist" id="type" class="ownerMembership"-->
                                            <!--                                               data-value="-->
                                            <?php //echo $ownerMembership ?><!--"-->
                                            <!--                                               data-source="-->
                                            <?php //echo $ownerMemberships ?><!--"-->
                                            <!--                                               data-pk="-->
                                            <?php //echo singleQuote(array('user_id' => $user->id, 'type' => $ownerMembership)); ?><!--">-->
                                            <!--                                            </a>-->
                                            <!--                                            <br/>-->
                                            <!--                                            <a href="#" data-type="radiolist" id="type" class="brokerMembership"-->
                                            <!--                                               data-value="-->
                                            <?php //echo $brokerMembership ?><!--"-->
                                            <!--                                               data-source="-->
                                            <?php //echo $brokerMemberships ?><!--"-->
                                            <!--                                               data-pk="-->
                                            <?php //echo singleQuote(array('user_id' => $user->id, 'type' => $brokerMembership)); ?><!--">-->
                                            <!--                                            </a>-->
                                        </div>

                                    </div>
                                    <div class="form-group col-md-4">

                                        <div class="form-group">
                                            <?php echo form_label('Coupons : ', 'coupons'); ?><br/>
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
                                <div class="row">

                                    <div
                                        class="form-group col-md-3"> <?php echo form_label('First Name : ', 'first_name'); ?>
                                        <a href="#" id="first_name"><?php echo $user->first_name ?></a>
                                    </div>

                                    <div
                                        class="form-group col-md-3"> <?php echo form_label('M.I : ', 'middle_initial'); ?>
                                        <a href="#" id="middle_initial"
                                           data-type="text"><?php echo $user->middle_initial ?></a>
                                    </div>

                                    <div
                                        class="form-group col-md-3"> <?php echo form_label('Last Name : ', 'last_name'); ?>
                                        <a href="#" id="last_name" data-type="text">
                                            <?php echo $user->last_name ?></a>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <?php echo form_label('Gender : ', 'gender'); ?>
                                        <a href="#" id="gender" data-type="select"
                                           data-value="<?php echo $user->gender ?>"
                                           data-source="[{value:'M',text:'Male'},{value:'F',text:'Female'}]">
                                            <?php echo $user->gender ?></a>
                                    </div>

                                </div>


                                <div class="row">


                                    <div class="form-group col-md-3"> <?php echo form_label('SSN : ', 'ssn'); ?>
                                        <a href="#"
                                           id="<?php echo ($user->id == $this->session->userdata(USER_ID) || $role == BROKER) ? ssn : '' ?>"
                                           data-type="text"
                                           data-value="<?php echo $user->ssn ?>"><?php echo $user->ssn == '' ? $user->ssn : "[hidden]" ?></a>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <?php echo form_label('DOB : ', 'dob'); ?>
                                        <a href="#"
                                           id="<?php echo ($user->id == $this->session->userdata(USER_ID) || $role == BROKER) ? dob : '' ?>"
                                           data-type="date"
                                           data-value="<?php echo $user->dob ?>">
                                            <?php echo $user->dob == '' ? $user->dob : "[hidden]" ?></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6"> <?php echo form_label('Phone : ', 'phone'); ?>
                                        <a href="#" id="phone" data-type="text">
                                            <?php echo $user->personal_phone ?></a>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo form_label('Fax : ', 'fax'); ?>
                                        <a href="#" id="fax" data-type="text">
                                            <?php echo $user->personal_fax ?></a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <?php echo form_label('Street : ', 'street'); ?>
                                        <a href="#" id="street" data-type="text"
                                           data-pk="<?php echo $user->address_id ?>">
                                            <?php echo $user->street; ?></a>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <?php echo form_label('City : ', 'city'); ?>
                                        <a href="#" id="city" data-type="text"
                                           data-pk="<?php echo $user->address_id ?>">
                                            <?php echo $user->city; ?></a>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo form_label('State : ', 'state'); ?>
                                            <a href="#" id="state" data-type="select"
                                               data-value="<?php echo $user->address_id ?>"
                                               data-pk="<?php echo $user->address_id; ?>"
                                               data-source="<?php echo $state ?>"
                                               data-emptytext="select a state"><?php echo $user->state ?></a
                                                >
                                        </div>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <?php echo form_label('Zip Code : ', 'postal_code'); ?>
                                        <a href="#" id="postal_code" data-type="text"
                                           data-pk="<?php echo $user->address_id ?>">
                                            <?php echo $user->postal_code; ?></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <form
                                            action="<?php echo base_url() . 'administrator/user/update_profilePic' . '/' . $user->id; ?>"
                                            method="post" id="banner" enctype="multipart/form-data">
                                            <div class="form-group ">
                                                <?php if (!profileImageExists(base_url() . 'uploads/profile/' . $this->session->userdata(PROFILE_PIC))) { ?>
                                                    <img
                                                        src="<?php echo base_url() . 'uploads/profile/empty_profile.jpg' ?>">
                                                <?php } else { ?>
                                                    <img
                                                        src="<?php echo base_url() . 'uploads/profile/' . $user->profile_image; ?>"
                                                        height="128px" width="128px">
                                                <?php } ?>
                                            </div>
                                            <p>Profile Image : Max 1024*1024 .</p>
                                            <input type="file" onchange="this.form.submit()" name="profile_image"
                                                   id="profile_image" style="float: left;"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($role == BROKER && in_array('broker', $userRoles)): ?>
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Business</h3>
                                </div>
                                <div class="box-body">
                                    <?php foreach ($business as $business) { ?>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Site : ', 'site'); ?>
                                                <a href="#" id="site" data-type="text">
                                                    <?php echo $business->site ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Email : ', 'email'); ?>
                                                <a href="#" id="b_email" data-type="text">
                                                    <?php echo $business->email; ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Name : ', 'name'); ?>
                                                <a href="#" id="name" data-type="text">
                                                    <?php echo $business->name ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('D.B.A : ', 'dba'); ?>
                                                <a href="#" id="dba" data-type="text">
                                                    <?php echo $business->dba ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Phone : ', 'phone'); ?>
                                                <a href="#" id="b_phone" data-type="text">
                                                    <?php echo $business->b_phone ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Fax : ', 'fax'); ?>
                                                <a href="#" id="b_fax" data-type="text">
                                                    <?php echo $business->b_fax ?></a>
                                            </div>
                                        </div>
                                        <div class="row">

                                        </div>
                                        <div class="row">

                                            <div class="form-group  col-md-3">
                                                <?php echo form_label('Street : ', 'street'); ?>
                                                <a href="#" id="street" data-type="text"
                                                   data-pk=<?php echo $business->address_id; ?>>
                                                    <?php echo $business->street; ?></a>
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <?php echo form_label('City : ', 'city'); ?>
                                                <a href="#" id="city" data-type="text"
                                                   data-pk=<?php echo $business->address_id; ?>>
                                                    <?php echo $business->city; ?></a>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo form_label('State : ', 'state'); ?>
                                                <a href="#" id="state" data-type="select"
                                                   data-value="<?php echo $business->address_id ?>"
                                                   data-pk="<?php echo $business->address_id; ?>"
                                                   data-source="<?php echo $state ?>"
                                                   data-emptytext="select a state"><?php echo $business->state ?></a
                                                    >
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Zip Code : ', 'postal_code'); ?>
                                                <a href="#" id="postal_code" data-type="text"
                                                   data-pk=<?php echo $business->address_id; ?>>
                                                    <?php echo $business->postal_code; ?></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo form_label('Owner Commission % : ', 'owner_commission'); ?>
                                            <a href="#" id="owner_commission" data-type="text">
                                                <?php echo $business->owner_commission; ?></a>
                                        </div>
                                        <div class="form-group">
                                            <?php echo form_label('Client Commission % : ', 'client_commission'); ?>
                                            <a href="#" id="client_commission" data-type="text">
                                                <?php echo $business->client_commission; ?></a>
                                        </div>
                                        <div class="form-group">
                                            <?php echo form_label('Comment : ', 'comment'); ?>
                                            <a href="#" id="comment" data-type="text">
                                                <?php echo $user->comment ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <?php endif ?>
                    <div class="col-md-12">
                        <form method="post"
                              action="<?php echo base_url() . 'administrator/user/addUserNotes/' . $user->id; ?>"
                              id="addnote">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Notes</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <textarea style="width: 100%" name="note_validate"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="submit" value="Add Note" class="btn-primary">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php
                                        $dbDate = $note->updated;
                                        $convertDate = new DateTime($dbDate);
                                        $standard_date = $convertDate->format('m/d/y');
                                        ?>
                                        <?php foreach ($notes as $note) { ?>
                                            <div class="form-group col-md-11">
                                                <?php echo $standard_date ?> <br/>
                                                <a href="#" data-type="textarea" data-pk="<?php echo $note->id ?>"
                                                   id="note" name="note"><?php echo $note->note ?></a>
                                            </div>
                                            <?php if ($note->user_id == $this->session->userdata(USER_ID)) { ?>
                                                <div class="form-group col-md-1">
                                                    <a href="#" id="deleteNote"
                                                       onclick="return confirm('Are you sure you want to delete?')? deleteNote(<?php echo $note->id . ',' . $offset ?>): '';">
                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            <?php }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            <?php } ?>


            <section class="col-lg-5 connectedSortable ui-sortable">
                <?php if ($protype == 'employment' || ($protype == '')) { ?>
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Employment</h3><a style="padding-left: 5em" id="addemploy"
                                                                        href="#">add a new employee details</a>
                                <?php foreach ($employ as $key => $employ) { ?>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <div>Employment <?php echo $key + 1 ?></div>
                                            </div>
                                            <div class="form-group col-md-1 ">
                                                <div>
                                                    <a href="#" id="deleteEmp"
                                                       onclick="return confirm('Are you sure you want to delete?')? deleteEmployment(<?php echo $employ->id . ',' . $employ->user_id ?>): '';">
                                                        <span class="glyphicon glyphicon-trash"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <?php echo form_label('Employer : ', 'company'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="company"
                                                   data-type="text">
                                                    <?php echo $employ->company; ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Position : ', 'position'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="position"
                                                   data-type="text">
                                                    <?php echo $employ->position; ?></a>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Year : ', 'years'); ?>
                                                <a href="#" id="years" data-type="select"
                                                   data-value="<?php echo $employ->years ?>"
                                                   data-pk=<?php echo $employ->id; ?>
                                                   data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12},{value:13,text:13},{value:14,text:14},{value:15,text:15},{value:16,text:16},{value:17,text:17},{value:18,text:18},{value:19,text:19},{value:20,text:20}]' ?>"
                                                   data-emptytext="years"><?php echo $employ->years ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Month : ', 'months'); ?>
                                                <a href="#" id="months" data-type="select"
                                                   data-value="<?php echo $employ->months ?>"
                                                   data-pk=<?php echo $employ->id; ?>
                                                   data-source="<?php echo '[{value:1,text:1},{value:2,text:2},{value:3,text:3},{value:4,text:4},{value:5,text:5},{value:6,text:6},{value:7,text:7},{value:8,text:8},{value:9,text:9},{value:10,text:10},{value:11,text:11},{value:12,text:12}]' ?>"
                                                   data-emptytext="months"><?php echo $employ->months ?></a>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Yearly Salary : ', 'salary'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="salary"
                                                   data-type="text">
                                                    <?php echo '$' . $employ->salary; ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Phone : ', 'phone'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="phone_employment"
                                                   data-type="text">
                                                    <?php echo $employ->phone_employment; ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Street : ', 'street_employment'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="street_employment"
                                                   data-type="text">
                                                    <?php echo $employ->street_employment; ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('City : ', 'city_employment'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="city_employment"
                                                   data-type="text">
                                                    <?php echo $employ->city_employment; ?></a>
                                            </div>

                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Zip Code : ', 'zip_employment'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="zip_employment"
                                                   data-type="text">
                                                    <?php echo $employ->zip_employment; ?></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Url : ', 'web_address'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="web_address"
                                                   data-type="text">
                                                    <?php echo $employ->web_address; ?></a>
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Comment : ', 'comment_employment'); ?>
                                                <a href="#" data-pk="<?php echo $employ->id ?>" id="comment_employment"
                                                   data-type="text">
                                                    <?php echo $employ->comment_employment; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($protype == 'credit' || ($protype == '')) { ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Credit Application</h3><a style="padding-left: 5em" id="addcredit"
                            <a href="#">add a
                                new credit application details</a>
                            <?php foreach ($application as $key => $application) { ?>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <div>Application
                                                <?php echo $key + 1 ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2 ">
                                            <div>
                                                <a href="#" id="delete"
                                                   onclick="return confirm('Are you sure you want to delete?')? deleteCreditApplication(<?php echo $application->id . ',' . $application->user_id ?>): '';">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo form_label('Creditor: ', 'creditor'); ?>
                                            <a href="#" data-pk="<?php echo $application->id ?>" id="creditor"
                                               data-type="text">
                                                <?php echo $application->creditor; ?></a>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <?php echo form_label('Type : ', 'application_type'); ?>
                                            <a href="#" id="application_type" data-type="select"
                                               data-value="<?php echo $application->application_type ?>"
                                               data-pk=<?php echo $application->id; ?>
                                               data-source="<?php echo '[{value:\'credit_card\',text:\'Credit card\'},{value:\'auto\',text:\'Auto\'}, {value:\'mortgage\',text:\'Mortgage\'},{value:\'furniture\',text:\'Furniture\'},{value:\'others\',text:\'Others\'}]' ?>"
                                               data-emptytext="Select Credit Type"><?php if ($application->application_type == 'credit_card') echo 'Credit Card';
                                                elseif ($application->application_type == 'auto') echo 'Auto';
                                                elseif ($application->application_type == 'mortgage') echo 'Mortgage';
                                                elseif ($application->application_type == 'furniture') echo 'Furniture';
                                                elseif ($application->application_type == 'others') echo 'Others'; ?></a>
                                        </div>
                                        <?php
                                        $dbDate = DateTime::createFromFormat('Y-m-d', $application->applied);
                                        $standard_date = $dbDate->format('m/d/Y');
                                        ?>


                                        <div class="form-group  col-md-6">
                                            <?php echo form_label('Application Date : ', 'applied'); ?>
                                            <a href="#" data-pk="<?php echo $application->id ?>" id="applied"
                                               data-type="date">
                                                <?php echo $standard_date; ?></a>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="form-group  col-md-6">
                                            <?php echo form_label('Line Of Credit : ', 'amount'); ?>
                                            <a href="#" data-pk="<?php echo $application->id ?>" id="amount"
                                               data-type="text">
                                                <?php echo '$' . $application->amount; ?></a>
                                        </div>


                                        <div class="form-group  col-md-6">
                                            <?php echo form_label('Status : ', 'status'); ?>
                                            <a href="#" id="status" data-type="select"
                                               data-value="<?php echo $application->status ?>"
                                               data-pk=<?php echo $application->id; ?>
                                               data-source="<?php echo '[{value:0,text:\'Rejected\'},{value:1,text:\'Approved\'}]' ?>"
                                               data-emptytext="Select Status"><?php echo $application->status == '0' ? 'Rejected' : 'Approved' ?></a>

                                        </div>
                                        <?php if ($application->status == '1') {
                                            ?>
                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Due Day : ', 'due'); ?>
                                                <a href="#" data-pk="<?php echo $application->id ?>" id="due"
                                                   data-type="text">
                                                    <?php echo $application->due; ?></a>
                                            </div>
                                        <?php } else { ?>


                                            <div class="form-group  col-md-6">
                                                <?php echo form_label('Due Day : ', 'due'); ?>
                                                <a href="#" data-pk="#"
                                                   data-type="text">
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group  col-md-6">
                                            <?php echo form_label('Comment : ', 'comment_application'); ?>
                                            <a href="#" data-pk="<?php echo $application->id ?>"
                                               id="comment_application"
                                               data-type="text">
                                                <?php echo $application->comment_application; ?></a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
            </section>
        </div>
    </section>

    <div class="modal fade" id="employment" tabindex="-1" role="dialog"
         aria-labelledby="employment" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url() . 'administrator/employment/addEmployment'; ?>"
                      method="post"
                      id="addemploye">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="employment">Add a new Employement Details</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-body">
                                    <div class="form-group col-md-6">
                                        <label class="left">Employer:</label>
                                        <input type='text' class="form-control" id="company1" name="company1"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="left">Position:</label>
                                        <input type='text' class="form-control" id="position1"
                                               name="position1"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="sal">Yearly Salary:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                            <input type="text" class="form-control" id="sal" name="sal"/>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone number:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                            <input type="text" class="form-control"
                                                   id="phone1" name="phone1"
                                                   data-mask="(999) 999-9999" placeholder="(999) 999-9999"/>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label style="padding-left: 15px;">How long did you work here?</label>
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

                                        <div class="form-group col-md-6">
                                            <label for="Street1">Street:</label>
                                            <input data-type="text" class="form-control" id="street1"
                                                   name="street1"/>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="city1">City:</label>
                                        <input data-type="text" class="form-control" id="city1"
                                               name="city1"/>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="zip1">Zip Code:</label>
                                        <input data-type="text" class="form-control" id="zip1"
                                               name="zip1"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="web_address">Web Address:</label>
                                        <input data-type="text" class="form-control" id="web_address2"
                                               name="web_address"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="comment1">Comment:</label>
                                        <input data-type="text" class="form-control" id="comment1"
                                               name="comment1"/>
                                    </div>
                                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                                           value="<?php echo $user->id; ?>"/>
                                    <input type="hidden" class="form-control" id="type" name="protype"
                                           value="<?php echo $protype; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="credit" tabindex="-1" role="dialog"
         aria-labelledby="credit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url() . 'administrator/application/addCreditApplication'; ?>"
                      method="post"
                      id="credite">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="credit1">Add A New Credit Application</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="box box-danger">
                                <div class="box-body">
                                    <div class="form-group col-md-8">
                                        <label class="left">Creditor:</label>
                                        <input type='text' class="form-control" id="creditor1" name="creditor1"/>
                                    </div>
                                    <div class="form-group col-md-8">
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
                                    <div class="form-group col-md-8">
                                        <label for="join">Application Date:</label>

                                        <div class='input-group date'>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input data-type="text" class="form-control " id="applied1"
                                                   name="applied1" data-mask="00/00/0000" placeholder="MM/DD/YYYY"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="sal">Line Of Credit:</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                            <input type="text" class="form-control" id="amount1" name="amount1"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="sal">Status:</label>
                                        <?php
                                        $status = array(
                                            '0' => 'Rejected',
                                            '1' => 'Approved'
                                        );
                                        echo form_dropdown('status1', $status, '1', array('class' => 'form-control', 'id' => 'status1')) ?>
                                    </div>
                                    <div class="form-group col-md-8" id="due_day">
                                        <label for="join">Due Day:</label>

                                        <div class='input-group date'>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input data-type="text" class="form-control" id="due1"
                                                   name="due1" data-mask="00" placeholder="DD"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="comment4">Comment:</label>
                                        <input data-type="text" class="form-control" id="comment4"
                                               name="comment4"/>
                                    </div>
                                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                                           value="<?php echo $user->id; ?>"/>
                                    <input type="hidden" class="form-control" id="type" name="protype"
                                           value="<?php echo $protype; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Credit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upgradeMembership" tabindex="-1" role="dialog"
         aria-labelledby="upgradeMembership" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?php echo base_url() . 'administrator/application/addCreditApplication'; ?>"
                      method="post"
                      id="upgradeMember">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">Upgrade Membership</h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_radio('membershiptype', $clientMembership, '') ?>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">PayPal Payment</button>
                    </div>
                </form>
            </div>
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
        params: function (params) {
            params.table = 'address';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
            location.reload();
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
        placement: 'right',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="b_phone"  style="padding-right: 24px;">',
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
        placement: 'right',
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"   class="b_fax"  style="padding-right: 24px;">',
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

    $('#first_name,#last_name,#comment,#gender').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
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
        params: function (params) {
            params.table = 'business';
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

    $('#site,#name,#dba,#b_phone,#b_fax,#owner_commission,#client_commission').editable({
        pk: '<?php echo $user->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'business';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


    $('#street').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'address';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });
    $('#city*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text"  title="Only Alphabet" pattern="^[a-zA-Z\s]+$" style="padding-right: 24px;">',
        params: function (params) {
            params.table = 'address';
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

    $('#state').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params, newValue) {
            params.table = 'address';
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
