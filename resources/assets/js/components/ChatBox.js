import React, { Component } from 'react';
import ReactDOM from 'react-dom';
export default class ChatBox extends Component {
  constructor() {
    super();
    console.log('tests');
    window.Echo.channel(`messages`).listen('NewMessage', (e) => {
      console.log(e);
    });
  }
  render() {
    return (
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-md-12">
            <div className="card">
              <div className="card-header">Temp Room</div>
              <div className="card-body">This is the timer value: 2</div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
if (document.getElementById('chatbox')) {
  ReactDOM.render(<ChatBox />, document.getElementById('chatbox'));
}
