// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('.dataTable').DataTable({
    'order': [[5, "desc"]]
  });

  $('.dataTableCate').DataTable({
    'order': [[3, "desc"]]
  });
});
