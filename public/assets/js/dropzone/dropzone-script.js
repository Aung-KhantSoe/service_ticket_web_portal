var DropzoneExample = function () {
    var DropzoneDemos = function () {
        Dropzone.options.fileTypeValidation = {
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 100, 
            acceptedFiles: ".pptx,.ppt,.pdf",
            accept: function(file, done) {
                if (file.name == "presentation_en.ppt") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        };
    }
    return {
        init: function() {
            DropzoneDemos();
        }
    };
}();
DropzoneExample.init();