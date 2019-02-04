import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {sendMessage} from '../drivers/chat';
import {getInfo} from '../drivers/profile';
export default class ChatBox extends Component {
  constructor() {
    super();
    this.state = {
      info: {},
      messages: [
      ],
    };
    window.Echo.private(`messages`).listen('.text-message', (message) => {
      const messages = this.state.messages;
      messages.push(message);
      this.setState(messages);
    });
    
    getInfo((info) => {
      this.setState({info});
    }, () => {      
    })
    this.sendMessage = () => {
      const text = document.getElementById('text').value
      sendMessage(`${this.state.info.first_name}  ${this.state.info.last_name}`, text, () => {}, () => {})
    }
    this.input_changed = () => {
      console.log(`I'm Typing...`);
    }
  }
  render() {
    return (
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-md-12">
            <div className="card">
              {this.state.info.first_name == null?
                <div className="card-header">Temp Room </div>:
                <div className="card-header">Temp Room ({this.state.info.first_name + ' ' + this.state.info.last_name})</div>
              }
              <div className="card-body">
                <div className="row">
                  <div className="col-md-12">
                    <input id="text" placeholder="write something" onChange={this.input_changed}/>
                    <button onClick={this.sendMessage} className="btn btn-primary">send</button>
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-12 message">
                    {this.state.messages.map((item, index) => ( 
                      <div className="row" key={index}>
                        <div className="col-md-12">
                          <b>{item.name}:</b> {item.message}
                        </div>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
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
