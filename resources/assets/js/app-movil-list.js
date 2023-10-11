/**
 * Page Movil List
 */

'use strict';
console.log('resources/assets/js/app-movil-list.js');
// Datatable (jquery)
$(function () {
  let borderColor, bodyBg, headingColor;

  if (isDarkStyle) {
    borderColor = config.colors_dark.borderColor;
    bodyBg = config.colors_dark.bodyBg;
    headingColor = config.colors_dark.headingColor;
  } else {
    borderColor = config.colors.borderColor;
    bodyBg = config.colors.bodyBg;
    headingColor = config.colors.headingColor;
  }

  // Variable declaration for table
  var dt_movil_table = $('.datatables-moviles'),
    select2 = $('.select2'),
    movilView = baseUrl + 'app/movil/view/account',
    statusObj = {
      1: { title: 'Pending', class: 'bg-label-warning' },
      2: { title: 'Active', class: 'bg-label-success' },
      3: { title: 'Inactive', class: 'bg-label-secondary' }
    };

  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Seleccionar Base',
      dropdownParent: $this.parent()
    });
  }

  // Moviles datatable
  if (dt_movil_table.length) {
    var dt_movil = dt_movil_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'list.index'
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
          data: 'chapaMovil'
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
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          // Movil identidad y tipo ambulancia
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $name = full['identidadMovil'],
              $tipo = full['tipoAmbulancia'],
              $image = full['avatar'];
            if ($image) {
              // For Avatar image
              var $output =
                '<img src="' + assetsPath + 'img/avatars/' + $image + '" alt="Avatar" class="rounded-circle">';
            } else {
              // For Avatar badge
              var stateNum = Math.floor(Math.random() * 6);
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                $name = full['identidadMovil'],
                $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
            }
            // Creates full output for row
            var $row_output =
              '<div class="d-flex justify-content-start align-items-center identidadMovil">' +
              '<div class="avatar-wrapper">' +
              '<div class="avatar avatar-sm me-3">' +
              $output +
              '</div>' +
              '</div>' +
              '<div class="d-flex flex-column">' +
              '<a href="' +
              movilView +
              '" class="text-body text-truncate"><span class="fw-medium">' +
              $name +
              '</span></a>' +
              '<small class="text-muted">' +
              $tipo +
              '</small>' +
              '</div>' +
              '</div>';
            return $row_output;
          }
        },
        {
          // Tipo
          targets: 2,
          render: function (data, type, full, meta) {
            var $role = full['tipoAmbulancia'];
            var roleBadgeObj = {
              SVA:
                '<span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2"><i class="bx bx-user bx-xs"></i></span>',
              SVR:
                '<span class="badge badge-center rounded-pill bg-label-success w-px-30 h-px-30 me-2"><i class="bx bx-cog bx-xs"></i></span>',
            };
            return "<span class='text-truncate d-flex align-items-center'>" + roleBadgeObj[$role] + $role + '</span>';
          }
        },
        {
          // Base Operativa
          targets: 3,
          render: function (data, type, full, meta) {
            var $baseOp = full['baseMovil'];

            return '<span class="fw-medium">' + $baseOp + '</span>';
          }
        },
        {
          // User Status
          targets: 5,
          render: function (data, type, full, meta) {
            var $status = full['statusOperativo'];

            return '<span class="badge ' + statusObj[$status].class + '">' + statusObj[$status].title + '</span>';
          }
        },
        {
          // Acciones
          targets: -1,
          title: 'Acciones',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
               '<div class="d-inline-block text-nowrap">' +
               "<button class=\"btn btn-sm btn-icon edit-record\" data-id=\"".concat(full['id'], "\" data-bs-toggle=\"offcanvas\" data-bs-target=\"#offcanvasAddUser\"><i class=\"bx bx-edit\"></i></button>") +
               "<button class=\"btn btn-sm btn-icon delete-record\" data-id=\"".concat(full['id'], "\"><i class=\"bx bx-trash\"></i></button>") +
               '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>' +
               '<div class="dropdown-menu dropdown-menu-end m-0">' + '<a href="' +
               movilView +
               '" class="dropdown-item">Perfil</a>' +
               '<a href="javascript:;" class="dropdown-item">Suspender</a>' +
               '</div>' +
               '</div>'
            );
          }
        }
      ],
      order: [[1, 'desc']],
      dom:
        '<"row mx-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Buscar..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="bx bx-export me-1"></i>Exportar',
          buttons: [
            {
              extend: 'print',
              text: '<i class="bx bx-printer me-2" ></i>Imprimir',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                // prevent avatar to be print
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('identidadMovil')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', headingColor)
                  .css('border-color', borderColor)
                  .css('background-color', bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="bx bx-file me-2" ></i>CSV',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('identidadMovil')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'excel',
              text: '<i class="bx bxs-file-export me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('identidadMovil')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="bx bxs-file-pdf me-2"></i>PDF',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('identidadMovil')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="bx bx-copy me-2" ></i>Copiar',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('identidadMovil')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            }
          ]
        },
        {
          text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Agregar Nuevo Movil</span>',
          className: 'add-new btn btn-primary',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offcanvasAddMovil'
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detalles de ' + data['identidadMovil'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      },
      initComplete: function () {
        // Adding role filter once table initialized
        this.api()
          .columns(2)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="tipoAmbulancia" class="form-select text-capitalize"><option value=""> Seleccionar Tipo de Ambulancia </option></select>'
            )
              .appendTo('.tipoAmbu')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
          });
        // Adding basOp filter once table initialized
        this.api()
          .columns(3)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="baseMovil" class="form-select text-capitalize"><option value=""> Seleccionar Base </option></select>'
            )
              .appendTo('.baseOp')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
          });
        // Adding status filter once table initialized
        this.api()
          .columns(5)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="statusOperativo" class="form-select text-capitalize"><option value=""> Seleccione Status de Ambulancia </option></select>'
            )
              .appendTo('.statusAmbu')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                select.append(
                  '<option value="' +
                    statusObj[d].title +
                    '" class="text-capitalize">' +
                    statusObj[d].title +
                    '</option>'
                );
              });
          });
      }
    });
    // To remove default btn-secondary in export buttons
    $('.dt-buttons > .btn-group > button').removeClass('btn-secondary');
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
      $('#identidadMovil').val(data.identidadMovil);
      $('#chapaMovil').val(data.chapaMovil);
      $('#chasisMovil').val(data.chasisMovil);
      $('#marcaMovil').val(data.marcaMovil);
      $('#modeloMovil').val(data.modeloMovil);
      $('#yearMovil').val(data.yearMovil);
      $('#tipoMovil').val(data.tipoMovil);
      $('#tipoAmbulancia').val(data.tipoAmbulancia);
      $('#tarjetaPETROPAR').val(data.tarjetaPETROPAR);
      $('#motorMovil').val(data.motorMovil);
      $('#capacidadTanque').val(data.capacidadTanque);
      $('#raspMovil').val(data.raspMovil);
      $('#baseMovil').val(data.baseMovil).trigger('change');
  });
  });

  // changing the title
  $('.add-new').on('click', function () {
    $('#movil_id').val(''); //reseting input field
    $('#offcanvasAddMovilLabel').html('Agregar Movil');
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

// Validation
// (function () {
//   // Add New User Form Validation
//   const fv = FormValidation.formValidation(addNewMovilForm, {
//     fields: {
//       modalEditMovilIdentidadMovil: {
//         validators: {
//           notEmpty: {
//             message: 'Por favor ingrese la identidad a ser utiliza por el movil'
//           },
//           regexp: {
//             regexp: /^[a-zA-Z0-9]+$/,
//             message: 'La identidad del movil solo puede contener numeros y letras'
//           }
//         }
//       },
//       modalEditMovilChapa: {
//         validators: {
//           notEmpty: {
//             message: 'Por favor ingrese una chapa'
//           },
//           regexp: {
//             regexp: /^(?:[a-zA-Z]{3}[0-9]{3}|[a-zA-Z]{4}[0-9]{3})$/,
//                   message: 'El número de chapa debe seguir uno de los formatos: ABC123 o ABCD123'
//           }
//         }
//       },
//       modalEditMovilChasis: {
//         validators: {
//           stringLength: {
//             min: 17,
//             max: 17,
//             message: 'El numero de chasis debe contener 17 caracteres'
//           },
//           regexp: {
//             regexp: /^[a-zA-Z0-9]+$/,
//             message: 'El numero de chasis solo puede contener numeros y letras'
//           }
//         }
//       },
//       modalEditMovilIdentidadMarca: {
//         validators: {
//           notEmpty: {
//             message: 'Seleccione una marca'
//           }
//         }
//       },
//       modalEditMovilTipo: {
//         validators: {
//           notEmpty: {
//             message: 'Seleccione un tipo de vehículo'
//           }
//         }
//       },
//       modalEditMovilTipoAmbulancia: {
//         validators: {
//           notEmpty: {
//             message: 'Seleccione un tipo de ambulancia'
//           }
//         }
//       },
//       modalEditMovilBaseMovil: {
//         validators: {
//           notEmpty: {
//             message: 'Seleccione un establecimiento como base del movil'
//           }
//         }
//       },
//     },
//     plugins: {
//       trigger: new FormValidation.plugins.Trigger(),
//       bootstrap5: new FormValidation.plugins.Bootstrap5({
//         // Use this for enabling/changing valid/invalid class
//         eleValidClass: '',
//         rowSelector: '.col-12'
//       }),
//       submitButton: new FormValidation.plugins.SubmitButton(),
//       // Submit the form when all fields are valid
//       // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
//       autoFocus: new FormValidation.plugins.AutoFocus()
//     }
//   });

//   fv.on('core.form.valid', function() {
//       // Cuando el formulario es válido, ejecutamos el siguiente código:

//       // Obtenemos la acción y el método del formulario
//       var formAction = $(addNewMovilForm).attr('action');
//       var formMethod = $(addNewMovilForm).attr('method');

//       // Enviamos el formulario usando AJAX
//       $.ajax({
//           type: formMethod,
//           url: formAction,
//           data: $(addNewMovilForm).serialize(),
//           success: function(response) {
//               // Aquí puedes manejar la respuesta exitosa, por ejemplo:
//               alert('Móvil guardado exitosamente!');
//           },
//           error: function(error) {
//               // Aquí puedes manejar los errores, por ejemplo:
//               alert('Hubo un error al guardar el móvil.');
//           }
//       });
//   });
// })();
