<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="subcontainer">
            <?php echo heading('Your Calendars', 3); ?>
            <a href="<?php echo site_url(array('calendar/new_calendar')); ?>">Create Calendar</a>
            <br/>
            <br/>
            <?php if (isset($success)) { ?>
                <div class="success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php } ?>
            <div>
                <div style="float:left; width:75%;">Name</div>
                <div style="float:left; width:24%;">Actions</div>
            </div>
            <br/>
            <br/>
            <?php foreach($calendars as $calendar) { ?>
                <div>
                    <div style="float:left; width:75%; color:<?php echo $calendar['color']; ?>">
                        <?php echo $calendar['name']; ?>
                    </div>
                    <div style="float:left; width:25%;">
                        <a href="<?php echo site_url(array('calendar/update', $calendar['cal_id'])); ?>">Edit</a>
                        <a href="<?php echo site_url(array('calendar/delete', $calendar['cal_id'])); ?>">Delete</a>
                    </div>
                </div>
            <?php } ?>
            <br/><br/>
        </div>
    </div>
</div>
