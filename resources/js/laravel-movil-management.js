(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory();
	else if(typeof define === 'function' && define.amd)
		define([], factory);
	else {
		var a = factory();
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function() {
return /******/ (function() { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/laravel-movil-management.js ***!
  \*************************************************/
/**
 * Page Movil List
 */



// Datatable (jquery)
$(function () {
  // Variable declaration for table
  var dt_movil_table = $('.datatables-moviles'),
    select2 = $('.select2'),
    movilView = baseUrl + 'app/movil/view/account',
    offCanvasForm = $('#offcanvasAddMovil');
  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Seleccionar Base Operativa',
      dropdownParent: $this.parent()
    });
  }

  // ajax setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Moviles datatable
  if (dt_movil_table.length) {
    var dt_movil = dt_movil_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'movil-list'
      },
      columns: [
      // columns according to JSON
      {
        data: ''
      }, {
        data: 'id'
      }, {
        data: 'identidadMovil'
      }, {
        data: 'baseMovil'
      }, {
        data: 'tipoAmbuIcon'
      }, {
        data: 'statusOperativo'
      }, {
        data: 'statusActivo'
      }, {
        data: 'marcaLogo'
      }, {
        data: 'action'
      }],
      columnDefs: [{
        // For Responsive
        className: 'control',
        searchable: false,
        orderable: false,
        responsivePriority: 2,
        targets: 0,
        render: function render(data, type, full, meta) {
          return '';
        }
      }, {
        searchable: false,
        orderable: false,
        targets: 1,
        render: function render(data, type, full, meta) {
          return "<span>".concat(full.fake_id, "</span>");
        }
      }, {
        // Movil identidad
        targets: 2,
        responsivePriority: 4,
        render: function render(data, type, full, meta) {
          var $identidadMovil = full['identidadMovil'];

          // For Avatar badge
          var stateNum = statusOperativo;// Math.floor(Math.random() * 6);
          var states = ['gray','dark','danger','orange', 'warning','success'];
          var $state = states[stateNum],
              $identidadMovil = full['identidadMovil'],
              $marcaLogo = full['marcaLogo'],
              $output;

          var match = $identidadMovil.match(/([A-Za-z])(\d+)$/);
          if (match && match.length > 2) {
              $initials = match[1] + match[2];
          } else {
              $initials = $identidadMovil; // Fallback en caso de que no haya coincidencia
          }

          if ($marcaLogo) {
              $output = '<img src="' + $marcaLogo + '" alt="' + $identidadMovil + '" class="avatar-img rounded-circle bg-label-' + $state + '">';
          } else {
              $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
          }

          // Creates full output for row
          var $row_output = '<div class="d-flex justify-content-start align-items-center movil-name">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar avatar-sm me-3">' + $output + '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="' + movilView + '" class="text-body text-truncate"><span class="fw-medium">' + $identidadMovil + '</span></a>' +
              '</div>' +
              '</div>';
          return $row_output;
        }
      }, {
        // movil BaseOp
        targets: 3,
        render: function render(data, type, full, meta) {
          var $baseMovil = full['baseMovil'];
          return '<span class="movil-baseOp">' + $baseMovil + '</span>';
        }
      }, {
        // tipo Ambulancia
        targets: 4,
        className: 'text-center',
        render: function render(data, type, full, meta) {
            var $tipoAmbuIcon = full['tipoAmbuIcon'];
            var $statusActivo = full['statusActivo'];
            var $icon;

            // Definimos el icono según el valor de statusActivo
            if ($statusActivo > 1) {
                $icon = "<i class='bx bx-wind text-danger'></i>";
            } else if ($statusActivo === 1) {
                $icon = "<i class='bx bx-coffee text-success'></i>";
            } else {
                $icon = "<i class='bx bxs-traffic-barrier text-gray'></i>";
            }

            // Construimos la salida combinando el tipoAmbuIcon y el icono
            return "<img src='" + baseUrl + $tipoAmbuIcon + "' alt='Tipo Ambulancia' class='mr-2'>" + $icon;
        }
      }, {
        // Actions
        targets: -1,
        title: 'Acciones',
        searchable: false,
        orderable: false,
        render: function render(data, type, full, meta) {
          return '<div class="d-inline-block text-nowrap">' + "<button class=\"btn btn-sm btn-icon edit-record\" data-id=\"".concat(full['id'], "\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasAddMovil\"><i class=\"bx bx-edit\"></i></button>") + "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"bx bx-trash\"></i></button>") + '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>' + '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' + movilView + '" class="dropdown-item">Ver</a>' + '<a href="javascript:;" class="dropdown-item">Suspender</a>' + '</div>' + '</div>';
        }
      }],
      order: [[2, 'desc']],
      dom: '<"row mx-2"' + '<"col-md-2"<"me-3"l>>' + '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' + '>t' + '<"row mx-2"' + '<"col-sm-12 col-md-6"i>' + '<"col-sm-12 col-md-6"p>' + '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Buscar..'
      },
      // Buttons with Dropdown
      buttons: [{
        extend: 'collection',
        className: 'btn btn-label-secondary dropdown-toggle mx-3',
        text: '<i class="bx bx-export me-2"></i>Export',
        buttons: [{
          extend: 'print',
          title: 'Moviles',
          text: '<i class="bx bx-printer me-2" ></i>Print',
          className: 'dropdown-item',
          exportOptions: {
            columns: [2, 3],
            // prevent avatar to be print
            format: {
              body: function body(inner, coldex, rowdex) {
                if (inner.length <= 0) return inner;
                var el = $.parseHTML(inner);
                var result = '';
                $.each(el, function (index, item) {
                  if (item.classList !== undefined && item.classList.contains('movil-name')) {
                    result = result + item.lastChild.textContent;
                  } else result = result + item.innerText;
                });
                return result;
              }
            }
          },
          customize: function customize(win) {
            //customize print view for dark
            $(win.document.body).css('color', config.colors.headingColor).css('border-color', config.colors.borderColor).css('background-color', config.colors.body);
            $(win.document.body).find('table').addClass('compact').css('color', 'inherit').css('border-color', 'inherit').css('background-color', 'inherit');
          }
        }, {
          extend: 'csv',
          title: 'Moviles',
          text: '<i class="bx bx-file me-2" ></i>Csv',
          className: 'dropdown-item',
          exportOptions: {
            columns: [2, 3],
            // prevent avatar to be print
            format: {
              body: function body(inner, coldex, rowdex) {
                if (inner.length <= 0) return inner;
                var el = $.parseHTML(inner);
                var result = '';
                $.each(el, function (index, item) {
                  if (item.classList.contains('movil-name')) {
                    result = result + item.lastChild.textContent;
                  } else result = result + item.innerText;
                });
                return result;
              }
            }
          }
        }, {
          extend: 'excel',
          title: 'Moviles',
          text: '<i class="bx bxs-file-export me-1"></i>Excel',
          className: 'dropdown-item',
          exportOptions: {
            columns: [2, 3],
            // prevent avatar to be display
            format: {
              body: function body(inner, coldex, rowdex) {
                if (inner.length <= 0) return inner;
                var el = $.parseHTML(inner);
                var result = '';
                $.each(el, function (index, item) {
                  if (item.classList.contains('movil-name')) {
                    result = result + item.lastChild.textContent;
                  } else result = result + item.innerText;
                });
                return result;
              }
            }
          }
        }, {
          extend: 'pdf',
          title: 'Moviles',
          text: '<i class="bx bxs-file-pdf me-2"></i>Pdf',
          className: 'dropdown-item',
          exportOptions: {
            columns: [2, 3],
            // prevent avatar to be display
            format: {
              body: function body(inner, coldex, rowdex) {
                if (inner.length <= 0) return inner;
                var el = $.parseHTML(inner);
                var result = '';
                $.each(el, function (index, item) {
                  if (item.classList.contains('movil-name')) {
                    result = result + item.lastChild.textContent;
                  } else result = result + item.innerText;
                });
                return result;
              }
            }
          }
        }, {
          extend: 'copy',
          title: 'Moviles',
          text: '<i class="bx bx-copy me-2" ></i>Copy',
          className: 'dropdown-item',
          exportOptions: {
            columns: [2, 3],
            // prevent avatar to be copy
            format: {
              body: function body(inner, coldex, rowdex) {
                if (inner.length <= 0) return inner;
                var el = $.parseHTML(inner);
                var result = '';
                $.each(el, function (index, item) {
                  if (item.classList.contains('movil-name')) {
                    result = result + item.lastChild.textContent;
                  } else result = result + item.innerText;
                });
                return result;
              }
            }
          }
        }]
      }, {
        text: '<i class="bx bx-plus me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Agregar Nuevo Movil</span>',
        className: 'add-new btn btn-primary',
        attr: {
          'data-bs-toggle': 'offcanvas',
          'data-bs-target': '#offcanvasAddMovil'
        }
      }],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function header(row) {
              var data = row.data();
              return 'Detalles de ' + data['identidadMovil'];
            }
          }),
          type: 'column',
          renderer: function renderer(api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
              ? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' + '<td>' + col.title + ':' + '</td> ' + '<td>' + col.data + '</td>' + '</tr>' : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }

  // Delete Record
  $(document).on('click', '.delete-record', function () {
    var movil_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // sweetalert for confirmation of delete
    Swal.fire({
      title: 'Esta seguro?',
      text: "No podrás deshacer esta acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, eliminar!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        // delete the data
        $.ajax({
          type: 'DELETE',
          url: "".concat(baseUrl, "movil-list/").concat(movil_id),
          success: function success() {
            dt_movil.draw();
          },
          error: function error(_error) {
            console.log(_error);
          }
        });

        // success sweetalert
        Swal.fire({
          icon: 'success',
          title: 'Eliminado!',
          text: 'El movil ha sido eliminado!',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelado',
          text: 'El movil no ha sido eliminado!',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  });

  // edit record
  $(document).on('click', '.edit-record', function () {
    var movil_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // changing the title of offcanvas
    $('#offcanvasAddMovilLabel').html('Editar Movil');

    // get data
    $.get("".concat(baseUrl, "movil-list/").concat(movil_id, "/edit"), function (data) {
      $('#movil_id').val(data.id);
      $('#add-movil-identidadMovil').val(data.identidadMovil);
      $('#add-movil-chapaMovil').val(data.chapaMovil);
      $('#add-movil-chasisMovil').val(data.chasisMovil);
      $('#add-movil-marcaMovil').val(data.marcaMovil);
      $('#add-movil-modeloMovil').val(data.modeloMovil);
      $('#add-movil-tipoMovil').val(data.tipoMovil);
      $('#add-movil-tipoAmbulancia').val(data.tipoAmbulancia);
      $('#add-movil-añoMovil').val(data.añoMovil);
      $('#add-movil-motorMovil').val(data.motorMovil);
      $('#add-movil-capacidadTanque').val(data.capacidadTanque);
      $('#add-movil-raspMovil').val(data.raspMovil);
      $('#add-movil-baseMovil').val(data.baseMovil);
    });
  });

  // changing the title
  $('.add-new').on('click', function () {
    $('#movil_id').val(''); //reseting input field
    $('#offcanvasAddMovilLabel').html('Agregar Movil');
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(function () {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  // validating form and updating movil's data
  var addNewMovilForm = document.getElementById('addNewMovilForm');

  // movil form validation
  var fv = FormValidation.formValidation(addNewMovilForm, {
    fields: {
      identidadMovil: {
        validators: {
          notEmpty: {
            message: 'El campo de identidad del Movil no puede estar vacío.'
          },
          regexp: {
            regexp: /^[A-Z]{4}\d{2,4}$/,
            message: 'Por favor ingresa correctamente la identidad del Movil. Debe ser 4 letras mayúsculas seguidas de 2 a 4 números.'
          }
        }
      },
      chapaMovil: {
        validators: {
          notEmpty: {
            message: 'Ingresar la chapa del Movil'
          }
        }
      },
    //   userContact: {
    //     validators: {
    //       notEmpty: {
    //         message: 'Please enter your contact'
    //       }
    //     }
    //   },
    //   company: {
    //     validators: {
    //       notEmpty: {
    //         message: 'Please enter your company'
    //       }
    //     }
    //   }
     },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: '',
        rowSelector: function rowSelector(field, ele) {
          // field is the field name & ele is the field element
          return '.mb-3';
        }
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  }).on('core.form.valid', function () {
    // adding or updating movil when form successfully validate
    $.ajax({
      data: $('#addNewMovilForm').serialize(),
      url: "".concat(baseUrl, "movil-list"),
      type: 'POST',
      success: function success(status) {
        dt_movil.draw();
        offCanvasForm.offcanvas('hide');

        // sweetalert
        Swal.fire({
          icon: 'success',
          title: "Has logrado ".concat(status, "!"),
          text: "El movil se ha ".concat(status, " exitosamente."),
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      },
      error: function error(err) {
        offCanvasForm.offcanvas('hide');
        Swal.fire({
          title: 'Registro dupicado!',
          text: 'La chapa del movil debe ser única.',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  });

  // clearing form data when offcanvas hidden
  offCanvasForm.on('hidden.bs.offcanvas', function () {
    fv.resetForm(true);
  });
  var phoneMaskList = document.querySelectorAll('.phone-mask');

  // Phone Number
  if (phoneMaskList) {
    phoneMaskList.forEach(function (phoneMask) {
      new Cleave(phoneMask, {
        phone: true,
        phoneRegionCode: 'PY'
      });
    });
  }
});
/******/ 	return __webpack_exports__;
/******/ })()
;
});
