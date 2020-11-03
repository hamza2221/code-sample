import React, { Component } from 'react'
import { toast } from 'react-toastify';

import HttpClient from '../utils/httpClient'

export default class VerificationModal extends Component {
    constructor(props) {
        super(props)

        this.state = {
            verification_code: ""
        }
        this.handleChange = this.handleChange.bind(this)
        this.submitVerificationCode = this.submitVerificationCode.bind(this)
    }

    handleChange(event) {
        this.setState({ [event.target.name]: event.target.value });
    }

    submitVerificationCode() {
        HttpClient.post('/verification', { verification_code: this.state.verification_code, job_id: this.props.job.id }).then(response => {
            toast.success("Code verified successfully.");
            (this.props.callback)(true);
        }, function () {
            toast.error("Error occured.")
        });
    }

    render() {
        if (this.props.show == false) return null;
        return (
            <div className="modal-dialog fade show" tabIndex="-1" role="dialog">
                <div className="modal-dialog" role="document">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title">Verification Required</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <p>A verification code has been emailed to your email address. Kindly enter that code in the field below and click the <strong>Check</strong> button.</p>
                            <input name="verification_code" type="number" className="form-group" onChange={this.handleChange} value={this.state.verification_code} />
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-primary" onClick={this.submitVerificationCode}>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}