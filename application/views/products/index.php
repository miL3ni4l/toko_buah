<div class="row">

<table>
<th>ID</th>
<th>Nama</th>
<th>Harga</th>>
<th>Description</th>

<?php foreach ($products as $key => $value) { ?>
<tr>
<td><?php echo $value->product_id; ?></td>
<td><?php echo $value->name; ?></td>
<td><?php echo $value->price; ?></td>
<td><?php echo $value->description; ?></td> 
</tr>
  <?php } ?>
}> 
</table>

</div>