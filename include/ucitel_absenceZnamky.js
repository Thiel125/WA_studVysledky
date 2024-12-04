function oknoZnamky(id, nazev) {
  window.open("ucitel_zapisZnamek.php?id="+id, nazev, "width=1200,height=800");
}
function oknoAbsence(id, nazev) {
  window.open("ucitel_zapisAbsence.php?id="+id, nazev, "width=1200,height=800");
}
function oknoEdit(id) {
  window.open("ucitel_editZnamky.php?id=" + id, "_blank", "width=800,height=600");
}
function omluvit(ID_student) {
  $.ajax({
    url: "ucitel_omluvaAbsence.php",
    method: "POST",
    data: { ID_student: ID_student },
    success: function(response) {
      $("tr[data-student-id='" + ID_student + "']").remove();
      
    }
  });
}

