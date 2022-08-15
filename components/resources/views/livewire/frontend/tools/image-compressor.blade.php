<div>

        <div class="image-container mb-3">

            <div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            
            <div class="image-wrapper {{ ($convertType == 'remoteURL') ? 'show-remote-box' : '' }}">

                <form method="post" action="{{ url('image-compressor') }}" class="local-image-box dropzone cursor-pointer">
                    @csrf
                    <div class="dropzone-box">
{{--                         <div class="d-flex mb-auto flex-start">
                            <small class="ms-auto text-muted">{{ __('Up to 20 files') }}</small>
                        </div> --}}

                        <div class="dz-message">
                            <div class="m-4 text-center">
                                <h3 class="text-muted">{{ __('Drag and drop an image here') }}</h3>
                                <p>- {{ __('or') }} - </p>
                                <a class="btn btn-success cursor-pointer">{{ __('Choose an image') }}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive" id="previews" wire:ignore>
            <table id="template" class="table table-vcenter card-table table-bordered">
                <thead>
                    <tr>
                      <th>{{ __('Preview') }}</th>
                      <th>{{ __('File Name') }}</th>
                      <th>{{ __('Status') }}</th>
                      <th>{{ __('Old Size') }}</th>
                      <th>{{ __('New Size') }}</th>
                      <th>{{ __('Saved') }}</th>
                      <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="blur-shadow-image"><img class="avatar" data-dz-thumbnail /></td>
                        <td><span data-dz-name></span></td>
                        <td>
                            <span class="status">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-indeterminate bg-primary"></div>
                                </div>
                            </span>
                        </td>
                        <td><span class="old_size">--</span></td>
                        <td><span class="new_size">--</span></td>
                        <td><span class="saved">--</span></td>
                        <td><a class="action btn btn-success" download>{{ __('Download') }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

</div>

<script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
<link href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet">

<script>
(function( $ ) {
  "use strict";

    Dropzone.autoDiscover = false;

    document.addEventListener('livewire:load', function () {

        var previewNode = document.querySelector("#template");

        previewNode.id = "";

        var previewTemplate = previewNode.parentNode.innerHTML;

        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(".dropzone", {
            previewTemplate: previewTemplate,
            previewsContainer: "#previews",
            uploadMultiple: true,
            parallelUploads: 1,
            maxFiles: 1,
            acceptedFiles: ".jpeg,.jpg,.png",
            addRemoveLinks: false,
            timeout: 60000,
            init: function() {
              this.on("maxfilesexceeded", function(file) {
                    this.removeAllFiles();
                    this.addFile(file);
              });
            },
            success: function (file, response) {
                $('.old_size').text(response['old_size']);
                $('.status').text(response['status']);
                $('.new_size').text(response['new_size']);
                $('.saved').text(response['saved']);
                $('a.action').attr('href', response['link'])
            },
            error: function (file, response) {
                return false;
            }
        });

    });

})( jQuery );
</script>