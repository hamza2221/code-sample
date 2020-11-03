import React from 'react';
import ReactDOM from 'react-dom';
import { ToastContainer } from 'react-toastify';

import Header from './layouts/header';
import Footer from './layouts/footer';
import Main from './components/main';

import 'react-toastify/dist/ReactToastify.min.css'
import './app.css'

function App() {
    return (
        <div className="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
            <Header />
            <Main />
            <Footer />
            <ToastContainer />
        </div>
    );
}

export default App;

if (document.getElementById('root')) {
    ReactDOM.render(<App />, document.getElementById('root'));
}
