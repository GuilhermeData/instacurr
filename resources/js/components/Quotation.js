import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Quotation extends Component {
    
    constructor(props) {
        
        super(props);
        
        this.currencyName = this.props.currency.split(" ")[0];
        this.currencyFlag = "./img/" + this.currencyName + "-flag.png";
        
        this.close = () => {
            $('#'+this.currencyName).hide(300);
            $('#icon'+this.currencyName).show(300);
            $('#askToShow').show();
        };
        
    }
         
    render() {
        return (
            <div className="col-md quotation-section" id={this.currencyName}>
                <div className="quotation-block">
                    <div className="row x-row">
                        <button className="btn btn-danger btn-x" onClick={this.close}>X</button>
                    </div>
                    <div className="row value-row">
                        <div className="col color-black">
                            R$ <span className="color-green fz-28">{this.props.value}</span> <br />
                            <img src={this.currencyFlag} width="23" />&nbsp;&nbsp;{this.props.currency}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

// Não precisa do ReactDOM.render aqui
