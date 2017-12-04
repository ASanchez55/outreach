<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="col-md-12">
                <div role="alert" class="alert alert-danger"><span>This family member will be deleted and you won't be able to find it anymore. </span></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <div class="col-md-12">
            	<a class="btn btn-success" type="button" href="<?php echo site_url("family/view/".$familyId); ?>">Cancel</a>
                <a class="btn btn-info" type="button" href="<?php echo site_url("familyMember/editFamilyMember/".$familyMemberId); ?>">Edit</a>
                <a class="btn btn-danger" type="button" href="<?php echo site_url("familyMember/deleteConfirmFamilyMember/".$familyMemberId); ?>">Delete</a>
            </div>
        </div>
    </div>
</div>