import React, { Component } from 'react'

export default class Header extends Component {
    render() {
        return (
            <header className="masthead mb-auto">
                <div className="inner">
                    <h3 className="masthead-brand">HomeOffice TimeTracker</h3>
                    <nav className="nav nav-masthead justify-content-center">
                        {/* <a class="nav-link active" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Contact</a> */}
                    </nav>
                </div>
            </header>
        )
    }
}
