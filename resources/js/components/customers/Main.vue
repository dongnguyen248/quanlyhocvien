<template>
  <div class="row">
    <div class="col-2"></div>
    <div class="col-md-10">
      <div class="card card-default">
        <div class="card-header text-center">Danh sách học viên</div>
        <div class="card-body">
          <router-view></router-view>
        </div>
      </div>
    </div>
    
  </div>
</template>
<script>
export default {
  name: "customer-main",
  
};
</script>