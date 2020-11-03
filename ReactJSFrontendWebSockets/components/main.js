import React, { Component } from 'react'
import { toast } from 'react-toastify';

import HttpClient from '../utils/httpClient'
import VerificationModal from './verification';

import Pusher from 'pusher-js'

export default class Main extends Component {

    constructor(props) {
        super(props)

        this.state = {
            job: { employer_email: "", employee_email: "", time_zone: "" },
            status: 'stopped',
            'timeElapsed': new Date(0, 0, 0, 0, 0, 0, 0),
            intervalFunctionId: null,
            verification: 'verified',
        }
        this.startTimer = this.startTimer.bind(this)
        this.pauseTimer = this.pauseTimer.bind(this)
        this.resumeTimer = this.resumeTimer.bind(this)
        this.stopTimer = this.stopTimer.bind(this)
        this.incrementTimer = this.incrementTimer.bind(this)

        this.handleChange = this.handleChange.bind(this)
        this.resetState = this.resetState.bind(this)
    }

    resetState() {
        this.setState({ job: { employer_email: "", employee_email: "", time_zone: "" }, verification: 'verified', status: 'stopped', 'timeElapsed': new Date(0, 0, 0, 0, 0, 0, 0), intervalFunctionId: null });
    }

    startTimer() {

        //Pusher.logToConsole = true;
        var pusher = new Pusher('94858b59285937f6c2e1', { cluster: 'eu', forceTLS: true });
        var channel = pusher.subscribe(this.state.job.employee_email);
        channel.bind('verification-generated', (data) => { this.pauseTimer(); this.setState({ 'verification': 'pending' }); });
        channel.bind('job-closed', (data) => { this.stopTimer(); });

        HttpClient.post('job', { ...this.state.job, 'device_token': "session-" + pusher.sessionID }).then(response => {
            this.setState({
                status: 'running',
                intervalFunctionId: window.setInterval(this.incrementTimer, 1000),
                job: response.data.job,
                timeLapse: response.data.time_lapse
            });
        }, function () {
            toast.error("Error occured.")
        });

    }

    pauseTimer() {
        HttpClient.put('time-lapse/' + this.state.timeLapse.id, { job_id: this.state.job.id }).then(response => {
            this.setState({ status: 'paused' });
            window.clearInterval(this.state.intervalFunctionId);
        }, function () {
            toast.error("Error occured.")
        });
    }

    resumeTimer() {
        HttpClient.post('time-lapse', { job_id: this.state.job.id }).then(response => {
            this.setState({
                status: 'running',
                intervalFunctionId: window.setInterval(this.incrementTimer, 1000),
                timeLapse: response.data.time_lapse
            });
        }, function () {
            toast.error("Error occured.")
        });
    }
    
    stopTimer() {
        HttpClient.put('time-lapse/' + this.state.timeLapse.id, { job_id: this.state.job.id }).then(response => {
            window.clearInterval(this.state.intervalFunctionId);
            this.resetState();
        }, function () {
            toast.error("Error occured.")
        });
    }
    
    handleChange(event) {
        this.setState({ job: { ...this.state.job, [event.target.name]: event.target.value } });
    }
    
    incrementTimer() {
        this.setState({ timeElapsed: new Date(this.state.timeElapsed.getTime() + 1000) });
    }
    render() {
        return (
            <main role="main" className="inner cover">
                <VerificationModal show={this.state.verification == "pending"} job={this.state.job} callback={(resp) => { this.setState({ verification: 'verified' }) }} />
                {this.state.status !== "stopped" ?
                    <React.Fragment>
                        <h1 className="cover-heading">Total Worktime Elapsed</h1>
                        <p className="lead">{this.state.timeElapsed.getHours()} : {this.state.timeElapsed.getMinutes()} : {this.state.timeElapsed.getSeconds()}</p>
                    </React.Fragment> : null}
                {this.state.status === "stopped" ?
                    <React.Fragment>
                        <h5 className="cover-heading">Employer Email</h5>
                        <p className="lead"><input type="email" name="employer_email" onChange={this.handleChange} value={this.state.job.employer_email} className="form-control" /></p>
                        <h5 className="cover-heading">Employee Email</h5>
                        <p className="lead"><input type="email" name="employee_email" onChange={this.handleChange} value={this.state.job.employee_email} className="form-control" /></p>
                        <h5 className="cover-heading">Select Timezone</h5>
                        <p className="lead">
                            <select name="time_zone" onChange={this.handleChange} value={this.state.job.time_zone} className="form-control">
                                <option value="" ></option>
                                <option value="-12:00">-12:00</option>
                                <option value="-11:00">-11:00</option>
                                <option value="-10:00">-10:00</option>
                                <option value="-09:00">-09:00</option>
                                <option value="-08:00">-08:00</option>
                                <option value="-07:00">-07:00</option>
                                <option value="-06:00">-06:00</option>
                                <option value="-05:00">-05:00</option>
                                <option value="-04:00">-04:00</option>
                                <option value="-03:00">-03:00</option>
                                <option value="-02:00">-02:00</option>
                                <option value="-01:00">-01:00</option>
                                <option value="00:00">00:00</option>
                                <option value="+01:00">+01:00</option>
                                <option value="+02:00">+02:00</option>
                                <option value="+03:00">+03:00</option>
                                <option value="+04:00">+04:00</option>
                                <option value="+05:00">+05:00</option>
                                <option value="+06:00">+06:00</option>
                                <option value="+07:00">+07:00</option>
                                <option value="+08:00">+08:00</option>
                                <option value="+09:00">+09:00</option>
                                <option value="+10:00">+10:00</option>
                                <option value="+11:00">+11:00</option>
                                <option value="+12:00">+12:00</option>
                            </select>
                        </p>
                    </React.Fragment> : null}
                <p className="lead">
                    {
                        this.state.status === "stopped" ? <button className="btn btn-lg btn-success m-1" onClick={this.startTimer}>START</button> : null
                    }
                    {
                        this.state.status === "paused" ? <button className="btn btn-lg btn-success m-1" onClick={this.resumeTimer}>RESUME</button> : null
                    }
                    {
                        this.state.status === "running" ? <button className="btn btn-lg btn-primary m-1" onClick={this.pauseTimer}>PAUSE</button> : null
                    }
                    {
                        this.state.status !== "stopped" ? <button className="btn btn-lg btn-danger m-1" onClick={this.stopTimer}>STOP</button> : null
                    }
                </p>
                <h5 className="cover-heading">How it works:</h5>
                {/* <p className="lead"> */}
                <ol className="text-align-left">
                    <li>Put in the mail of employee & the employer</li>
                    <li>Start the Time Tracker</li>
                    <li>The employee will receive mails in a random interval with a verification code</li>
                    <li>In order to keep the time tracker going. You need to put in the received code within a 4 minute time window.</li>
                    <li>If you need a break, just hit the pause button.</li>
                    <li>Once you’re finished with work, hit the stop button to receive an overview of your working hours. This overview will also be sent to the employer mail.</li>
                </ol>
                {/* </p> */}
            </main>
        )
    }
}