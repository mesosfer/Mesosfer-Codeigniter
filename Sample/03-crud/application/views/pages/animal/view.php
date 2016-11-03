<a href="animal/create">create new</a>&nbsp;<a href="user/signout">logout</a>
<table border="1" style="width:100%">
	<tr>
		<th>Object Id</th>
		<th>Name</th>
		<th>Foot</th>
		<th>Created At</th>
		<th>Update At</th>
		<th>Action</th>
	</tr>
	<?php foreach($animals as $row): ?>
	<tr>
		<td><?php echo $row->objectId ?></td>
		<td><?php echo $row->metadata->name ?></td>
		<td><?php echo $row->metadata->foot; ?></td>
		<td><?php echo $row->createdAt ?></td>
		<td><?php echo $row->updatedAt ?></td>
		<td>	
			<a href="<?php echo site_url('animal/edit/'.$row->objectId); ?>">Edit</a>
			<a href="<?php echo site_url('animal/delete/'.$row->objectId); ?>">Delete</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>