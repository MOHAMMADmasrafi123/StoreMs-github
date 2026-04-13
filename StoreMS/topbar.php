<style>
    .btn-darkblue {
        background-color: #0d6efd;
        color: white;
        border: none;
    }

    .btn-darkblue:hover {
        background-color: #0b5ed7;
        color: white;
    }
</style>
<div class="row p-3">
					<div class="col-sm-9">
						<h1><a href="index.php" class="text-barkblue text-decoration-none">Store Management System</a></h1>
					</div>
					<div class="col-sm-3">
						<p class="pt-3"><?php echo $user_first_name.' '.$user_last_name ?> 
							<a href="logout.php" class="text-white text-decoration-none btn btn-darkblue py-1 m-0">
								Logout
							</a>
						</p>
					</div>
				</div>