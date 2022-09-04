$(document).ready(function (){
  
  $("#btnCancelAddSkill").hide()
  $("#btnAddSkill").on("click", function (){
    $(this).hide()
    $("#btnCancelAddSkill").show()
    
    $("#addSkill").removeClass("d-none")
    $("#addSkill input").focus()
    
    $("#btnCancelAddSkill").on("click", function(){
      $("#addSkill").addClass("d-none")
      $("#btnAddSkill").show()
      $(this).hide()
    })
    
  })
})