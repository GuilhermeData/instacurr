/* global fetch */

import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Quotation from './Quotation';

export default class App extends Component {
    
    constructor(props) {
        
        super(props);
        
        this.state = {
            usd: 0,
            eur: 0,
            gbp: 0,
            ars: 0,
            updated_at: ''
        };
        
        let minutes = 5;
        
        this.fetchFromDatabase();
            
        setInterval(() => {
            this.fetchFromDatabase();
        }, 1000 * 60 * minutes);
    }
    
    fetchFromDatabase() {
        fetch("/quotations")
            .then(res => res.json())
            .then(
                (result) => {
                  this.updateState(result);
                },
                (error) => {
                  throw new Error(error);
                }
            );
    }
    
    updateState(data) {

        this.setState({
            usd: data.usd,
            eur: data.eur,
            gbp: data.gbp,
            ars: data.ars,
            updated_at: data.updated_at
        });
    }
       
    render() {
        return (
                
            <div className="container main-container">
                <div className="row first-row">
                    <div className="col-md-8 offset-md-1">
                        <h1>Insta Currency é o APP que mostra em tempo real, o valor em R$ das principais moedas do mercado mundial!</h1> 
                    </div>
                    <div className="col-md" id="relogio">
                        Atualizado em: {this.state.updated_at}
                    </div>
                </div>
                
                <div className="row">
                    <Quotation currency="USD Dólar" value={this.state.usd} />
                    <Quotation currency="EUR Euro" value={this.state.eur} />
                    <Quotation currency="GBP Libra" value={this.state.gbp} />
                    <Quotation currency="ARS Peso" value={this.state.ars} />
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
