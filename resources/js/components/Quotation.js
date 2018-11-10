import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Quotation extends Component {
    render() {
        
        let currencyFlag = "./img/" + this.props.currency.split(" ")[0] + "-flag.png";
        
        return (
            <div className="col-md quotation-section ">
                <div className="quotation-block">
                    <div className="row x-row">
                    &nbsp;&nbsp;X
                    </div>
                    <div className="row value-row">
                        <div className="col">
                            R$ <span className="color-green fz-28">{this.props.value}</span> <br />
                            <img src={currencyFlag} width="23" />&nbsp;&nbsp;{this.props.currency}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

// Não precisa do ReactDOM.render aqui
