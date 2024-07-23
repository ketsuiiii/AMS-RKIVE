@props(['value'])

{{-- @dd($value) --}}
<div class="modal fade" id="termsModal{{ $value }}" tabindex="-1" style="z-index: 2000;" aria-labelledby="termsLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsLabel">Agreement on Request Form Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    By submitting a request form to <b>Rkive Administrative Solutions ("RKIVE") </b>, you
                    <b>("{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}") </b> agree to the
                    following terms and conditions:
                    <br>
                    <br>
                    <b> 1. Responsibility for Information: </b>
                    <br>
                    a. Submitter acknowledges that they are responsible for the accuracy and completeness of the
                    information provided in the request form.
                    <br>
                    b. Submitter agrees not to enter any biased or misleading information in the request form.
                    <br>
                    <br>
                    <b> 2. Non-Discrimination: </b>
                    <br>
                    a. Submitter agrees not to discriminate against any individual or group based on race, color,
                    religion, gender, sexual orientation, national origin, age, or disability in the information
                    provided in the request form.
                    <br>
                    b. Submitter agrees to treat all individuals and groups fairly and impartially in the request
                    form.
                    <br>
                    <br>
                    <b> 3. Use of Information: </b>
                    <br>
                    a. The Company may use the information provided by Submitter for the purpose of evaluating and
                    processing the request.
                    <br>
                    b. Submitter acknowledges that the Company may use and disclose the information in accordance
                    with
                    applicable laws and regulations.
                    <br>
                    <br>
                    <b> 4. Compliance: </b>
                    <br>
                    a. Submitter agrees to comply with all applicable laws, regulations, and Company policies
                    related to
                    the submission of information in the request form.
                    <br>
                    b. Submitter agrees to indemnify and hold harmless the Company from any claims arising out of or
                    related to the submission of inaccurate, incomplete, or biased information.
                    <br>
                    <br>
                    <b> 7. Entire Agreement: </b>
                    <br>
                    This Agreement constitutes the entire agreement between the parties with respect to the subject
                    matter hereof and supersedes all prior agreements and understandings, whether written or oral,
                    relating to such subject matter.
                    <br>
                    <br>
                    <b> 8. Acceptance: </b>
                    <br>
                    Submitter acknowledges that by submitting a request form to the Company, they have read,
                    understood,
                    and agreed to be bound by the terms of this Agreement.
                </p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">I agree</button>
            </div>
        </div>
    </div>
</div>
