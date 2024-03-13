 <!-- Notification -->
 <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
     <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
         data-bs-auto-close="outside" aria-expanded="false">
         <i class="ti ti-bell ti-md"></i>
         <span class="badge bg-danger rounded-pill badge-notifications" style="display: none;"
             id="total_notification_span"></span>
     </a>
     <ul class="dropdown-menu dropdown-menu-end py-0">
         <li class="dropdown-menu-header border-bottom">
             <div class="dropdown-header d-flex align-items-center py-3">
                 <h5 class="text-body mb-0 me-auto">Notification</h5>
                 <span onclick="btn_tout_marquer_lu()" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip"
                     data-bs-placement="top" title="Mark all as read" ><i
                         class="ti ti-mail-opened fs-4"></i></span>
             </div>
         </li>
         <li class="dropdown-notifications-list scrollable-container">
             <ul class="list-group list-group-flush" id="ul_notitication">

             </ul>
         </li>
         {{--  <li class="dropdown-menu-footer border-top">
             <a href="javascript:void(0);"
                 class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                 View all notifications
             </a>
         </li> --}}
     </ul>
 </li>
 <!--/ Notification -->

 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script>
     $(document).ready(function() {
         setTimeout(function() {
             $.ajax({
                 type: 'GET',
                 url: '/client/get_notifications_non_lu',
                 dataType: 'json',
                 success: function(response) {
                     //console.log(response);
                     show_notification(response.total_notification);
                     var notifications = response.message;
                     updateTable(notifications);
                 },
                 error: function(error) {
                     console.error('Erreur de recuperation des notifications', error);
                 }
             });

             function updateTable(notifications) {
                 var ul_notitication = $("#ul_notitication");
                 ul_notitication.empty();
                 $.each(notifications, function(index, item) {
                     var row =
                         '<li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read"><div class="d-flex"><div class="flex-shrink-0 me-3"><div class="avatar"><span class="avatar-initial rounded-circle bg-label-warning"><i class="ti ti-alert-triangle"></i></span></div></div><div class="flex-grow-1"><h6 class="mb-1">' +
                         item.titre + '</h6><p class="mb-0">' + item.message +
                         '</p><small class="text-muted">' + item.created_at +
                         '</small></div></div></li>';

                     ul_notitication.append(row);
                 });
             }

             function show_notification(total_notification) {
                 if (total_notification > 0) {
                     $("#total_notification_span").show();
                     $("#total_notification_span").append(total_notification);
                 }
             }

         }, 2000);
     });
 </script>
 <script>
     function btn_tout_marquer_lu() {
             $.ajax({
                 type: 'GET',
                 url: '/client/tout_marquer_lu',
                 dataType: 'json',
                 success: function(response) {
                     $("#total_notification_span").hide();
                 },
                 error: function(error) {
                     console.error('Erreur de recuperation des notifications', error);
                 }
             });
         }

 </script>
