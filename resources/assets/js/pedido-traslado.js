/**
 *  Form Wizard
 */

'use strict';

(function () {
  // Init custom option check
  window.Helpers.initCustomOptionCheck();


  document.getElementById('estabOrigenID').addEventListener('change', function() {
    let idEst = this.value;
    fetch(`/get-servicios/${idEst}`)
    .then(response => response.json())
    .then(data => {
        let selectServicio = document.getElementById('servicioOrigenID');
        selectServicio.innerHTML = '<option selected>Seleccione Servicio</option>';
        data.forEach(servicio => {
            let option = document.createElement('option');
            option.value = servicio.idServ;
            option.textContent = servicio.NombreServ;
            selectServicio.appendChild(option);
        });
    });

    fetch(`/get-sectores/${idEst}`)
    .then(response => response.json())
    .then(data => {
        let selectSector = document.getElementById('sectorOrigenID');
        selectSector.innerHTML = '<option selected>Seleccione Sector</option>';
        data.forEach(sector => {
            let option = document.createElement('option');
            option.value = sector.idSector;
            option.textContent = sector.NombreSector;
            selectSector.appendChild(option);
        });
    });
});









  const flatpickrRange = document.querySelector('.flatpickr'),
    phoneMask = document.querySelector('.contact-number-mask'),
    plCountry = $('#plCountry'),
    plFurnishingDetailsSuggestionEl = document.querySelector('#plFurnishingDetails');

  // Phone Number Input Mask
  if (phoneMask) {
    new Cleave(phoneMask, {
      phone: true,
      phoneRegionCode: 'US'
    });
  }

  // select2 (Country)

  if (plCountry) {
    plCountry.wrap('<div class="position-relative"></div>');
    plCountry.select2({
      placeholder: 'Select country',
      dropdownParent: plCountry.parent()
    });
  }

  if (flatpickrRange) {
    flatpickrRange.flatpickr();
  }

  // Tagify (Furnishing details)
  const furnishingList = [
    'Fridge',
    'TV',
    'AC',
    'WiFi',
    'RO',
    'Washing Machine',
    'Sofa',
    'Bed',
    'Dining Table',
    'Microwave',
    'Cupboard'
  ];
  if (plFurnishingDetailsSuggestionEl) {
    const plFurnishingDetailsSuggestion = new Tagify(plFurnishingDetailsSuggestionEl, {
      whitelist: furnishingList,
      maxTags: 10,
      dropdown: {
        maxItems: 20,
        classname: 'tags-inline',
        enabled: 0,
        closeOnSelect: false
      }
    });
  }




  const sliderBasic = document.getElementById('slider-basic'),
  presionArterial = document.getElementById('presionArterial'),
  sliderSteps = document.getElementById('slider-steps'),
  sliderTap = document.getElementById('slider-tap'),
  sliderDrag = document.getElementById('slider-drag'),
  sliderFixedDrag = document.getElementById('slider-fixed-drag'),
  sliderCombined = document.getElementById('slider-combined-options'),
  sliderHover = document.getElementById('slider-hover'),
  sliderPips = document.getElementById('slider-pips');

// Basic
// --------------------------------------------------------------------

if (sliderBasic) {
  noUiSlider.create(sliderBasic, {
    start: [50],
    connect: [true, false],
    direction: isRtl ? 'rtl' : 'ltr',
    range: {
      min: 0,
      max: 100
    }
  });
}
colorOptions = {
  start: [30, 50],
  connect: true,
  behaviour: 'tap-drag',
  step: 10,
  tooltips: true,
  range: {
    min: 0,
    max: 100
  },
  pips: {
    mode: 'steps',
    stepped: true,
    density: 5
  }
}



noUiSlider.create(document.getElementById("glasgow"), {
  start: [15],
  behaviour: "tap-drag",
  step: 1,
  tooltips: true,
  connect: true,
  range: {
    min: 1,
    max: 15
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 1
  }

  });
  noUiSlider.create(document.getElementById("presionArterial"), {

    start: [80, 120],
    behaviour: "tap-drag",
    step: 5,
    tooltips: true,
    direction: isRtl ? 'ltr' : 'rtl',
    connect: true,
    range: {
      'min': 0,
      'max': 300
    },
    pips: {
      mode: "steps",
      stepped: true,
      density: 1
    }
  });
  noUiSlider.create(document.getElementById("frecuenciaCardiaca"), {
  start: [70],
  behaviour: "tap-drag",
  step: 1,
  tooltips: true,
  range: {
    min: 20,
    max: 200
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 10
  }
  });
  noUiSlider.create(document.getElementById("frecuenciaRespiratoria"), {
  start: [12],
  behaviour: "tap-drag",
  step: 1,
  tooltips: true,
  range: {
    min: 5,
    max: 30
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 1
  }
  });
  noUiSlider.create(document.getElementById("satO2"), {
  start: [99],
  behaviour: "tap-drag",
  step: 3,
  tooltips: true,
  range: {
    min: 40,
    max: 99
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 1
  }
  });
  noUiSlider.create(document.getElementById("tax"), {
  start: [36],
  behaviour: "drag",
  tooltips: true,
  range: {
    min: 33,
    max: 43
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 1
  }
  });
  noUiSlider.create(document.getElementById("glicemia"), {
  start: [80],
  behaviour: "tap-drag",
  step: 5,
  tooltips: true,
  range: {
    min: 40,
    max: 500
  },
  pips: {
    mode: "steps",
    stepped: true,
    density: 20
  }
  });







// // Vertical Tooltip
// const tooltipVerticalGL = document.getElementById('tooltipVerticalGL'),
//       tooltipVerticalFC = document.getElementById('tooltipVerticalFC'),
//       tooltipVerticalFR = document.getElementById('tooltipVerticalFR'),
//       connectVerticalSATO2 = document.getElementById('connectVerticalSATO2'),
//       tooltipVerticalTAX = document.getElementById('tooltipVerticalTAX'),
//       tooltipVerticalGLC = document.getElementById('tooltipVerticalGLC'),
//       connectVerticalPAD = document.getElementById('connectVerticalPAD'),
//       connectVerticalPAS = document.getElementById('connectVerticalPAS');

//       // Connect Upper
//       if (connectVerticalPAD) {
//         connectVerticalPAD.style.height = '200px';
//         noUiSlider.create(connectVerticalPAD, {
//           start: 80,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "tap-drag",
//           step: 5,
//           tooltips: true,
//           connect: "lower",
//           range: {
//             min: 20,
//             max: 220
//           }
//         });
//       };
//       if (connectVerticalPAS) {
//         connectVerticalPAS.style.height = "200px";
//         noUiSlider.create(connectVerticalPAS, {
//           start: 120,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "tap-drag",
//           step: 5,
//           tooltips: true,
//           connect: "lower",
//           range: {
//             min: 40,
//             max: 280
//           }
//         });
//       };

//       if (tooltipVerticalGL) {
//         tooltipVerticalGL.style.height = "200px";
//         noUiSlider.create(tooltipVerticalGL, {
//           start: 15,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "snap",
//           step: 1,
//           tooltips: true,
//           range: {
//             min: 1,
//             max: 15
//           }
//         });
//       };

//     if (tooltipVerticalFC) {
//       tooltipVerticalFC.style.height = "200px";
//       noUiSlider.create(tooltipVerticalFC, {
//         start: 70,
//         direction: isRtl ? 'rtl' : 'ltr',
//         orientation: "vertical",
//         behaviour: "drag",
//         step: 5,
//         tooltips: true,
//         range: {
//           min: 30,
//           max: 250
//         }
//       });
//     };

//       if (tooltipVerticalFR) {
//         tooltipVerticalFR.style.height = "200px";
//         noUiSlider.create(tooltipVerticalFR, {
//           start: 12,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "drag",
//           step: 1,
//           tooltips: true,
//           range: {
//             min: 5,
//             max: 30
//           }
//         });
//       };
//       if (connectVerticalSATO2) {
//         connectVerticalSATO2.style.height = "200px";
//         noUiSlider.create(connectVerticalSATO2, {
//           start: 99,
//           direction: isRtl ? 'ltr' : 'rtl',
//           connect: true,
//           orientation: "vertical",
//           behaviour: "tap-snap",
//           step: 3,
//           tooltips: true,
//           range: {
//             min: 30,
//             max: 99
//           }
//         });
//       };
//       if (tooltipVerticalTAX){
//         tooltipVerticalTAX.style.height = "200px";
//         noUiSlider.create(tooltipVerticalTAX, {
//           start: 36,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "drag",
//           tooltips: true,
//           range: {
//             min: 35,
//             max: 45
//           }
//         });
//       };
//       if (tooltipVerticalGLC){
//         tooltipVerticalTAX.style.height = "200px";
//         noUiSlider.create(tooltipVerticalTAX, {
//           start: 70,
//           direction: isRtl ? 'ltr' : 'rtl',
//           orientation: "vertical",
//           behaviour: "drag",
//           tooltips: true,
//           range: {
//             min: 30,
//             max: 600
//           }
//         });
//       };

//       // Limit
//       var limitVertical = document.getElementById("slider-vertical-limit");
//       limitVertical.style.height = "200px";
//       noUiSlider.create(limitVertical, {
//         start: [0, 40],
//         orientation: "vertical",
//         behaviour: "drag",
//         limit: 60,
//         tooltips: true,
//         connect: true,
//         range: {
//           min: 0,
//           max: 100
//         }
//       });

  // Vertical Wizard
  // --------------------------------------------------------------------

  const wizardPropertyListing = document.querySelector('#wizard-property-listing');
  if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
    // Wizard form
    const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-property-listing-form');
    // Wizard steps
    const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#personal-details');
    const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#property-details');
    const wizardPropertyListingFormStep3 = wizardPropertyListingForm.querySelector('#property-features');
    const wizardPropertyListingFormStep4 = wizardPropertyListingForm.querySelector('#property-area');
    const wizardPropertyListingFormStep5 = wizardPropertyListingForm.querySelector('#price-details');
    // Wizard next prev button
    const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-next'));
    const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));

    const validationStepper = new Stepper(wizardPropertyListing, {
      linear: true
    });

    // Personal Details
    const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
      fields: {
        // * Validate the fields here based on your requirements
        plFirstName: {
          validators: {
            notEmpty: {
              message: 'Please enter your first name'
            }
          }
        },
        plLastName: {
          validators: {
            notEmpty: {
              message: 'Please enter your last name'
            }
          }
        }
      },

      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          //* Move the error message out of the `input-group` element
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Property Details
    const FormValidation2 = FormValidation.formValidation(wizardPropertyListingFormStep2, {
      fields: {
        // * Validate the fields here based on your requirements

        plPropertyType: {
          validators: {
            notEmpty: {
              message: 'Please select property type'
            }
          }
        },
        plZipCode: {
          validators: {
            notEmpty: {
              message: 'Please enter zip code'
            },
            stringLength: {
              min: 4,
              max: 10,
              message: 'The zip code must be more than 4 and less than 10 characters long'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: function (field, ele) {
            // field is the field name & ele is the field element
            switch (field) {
              case 'plAddress':
                return '.col-lg-12';
              default:
                return '.col-sm-6';
            }
          }
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // select2 (Property type)
    const plPropertyType = $('#plPropertyType');
    if (plPropertyType.length) {
      plPropertyType.wrap('<div class="position-relative"></div>');
      plPropertyType
        .select2({
          placeholder: 'Select property type',
          dropdownParent: plPropertyType.parent()
        })
        .on('change.select2', function () {
          // Revalidate the color field when an option is chosen
          FormValidation2.revalidateField('plPropertyType');
        });
    }

    // Property Features
    const FormValidation3 = FormValidation.formValidation(wizardPropertyListingFormStep3, {
      fields: {
        // * Validate the fields here based on your requirements
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-sm-6'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      validationStepper.next();
    });

    // Property Area
    const FormValidation4 = FormValidation.formValidation(wizardPropertyListingFormStep4, {
      fields: {
        // * Validate the fields here based on your requirements
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-md-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // Jump to the next step when all fields in the current step are valid
      validationStepper.next();
    });

    // Price Details
    const FormValidation5 = FormValidation.formValidation(wizardPropertyListingFormStep5, {
      fields: {
        // * Validate the fields here based on your requirements
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          // Use this for enabling/changing valid/invalid class
          // eleInvalidClass: '',
          eleValidClass: '',
          rowSelector: '.col-md-12'
        }),
        autoFocus: new FormValidation.plugins.AutoFocus(),
        submitButton: new FormValidation.plugins.SubmitButton()
      }
    }).on('core.form.valid', function () {
      // You can submit the form
      // wizardPropertyListingForm.submit()
      // or send the form data to server via an Ajax request
      // To make the demo simple, I just placed an alert
      alert('Submitted..!!');
    });

    wizardPropertyListingNext.forEach(item => {
      item.addEventListener('click', event => {
        // When click the Next button, we will validate the current step
        switch (validationStepper._currentIndex) {
          case 0:
            FormValidation1.validate();
            break;

          case 1:
            FormValidation2.validate();
            break;

          case 2:
            FormValidation3.validate();
            break;

          case 3:
            FormValidation4.validate();
            break;

          case 4:
            FormValidation5.validate();
            break;

          default:
            break;
        }
      });
    });

    wizardPropertyListingPrev.forEach(item => {
      item.addEventListener('click', event => {
        switch (validationStepper._currentIndex) {
          case 4:
            validationStepper.previous();
            break;

          case 3:
            validationStepper.previous();
            break;

          case 2:
            validationStepper.previous();
            break;

          case 1:
            validationStepper.previous();
            break;

          case 0:

          default:
            break;
        }
      });
    });
  }
})();
