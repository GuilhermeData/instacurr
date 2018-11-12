/* global fetch */

import React, { Component } from 'react';
import ReactDOM from 'react-dom';

// Custom imports
import Quotation from './Quotation';

export default class App extends Component {
    
    constructor(props) {
        
        super(props);
        
        this.state = {
            usd: 0,
            eur: 0,
            gbp: 0,
            ars: 0,
            updated_at: false
        };
        
        let minutes = 5;
        
        this.fetchFromDatabase();
            
        setInterval(() => {
            this.fetchFromDatabase();
        }, 1000 * 60 * minutes);
    }
    
    fetchFromDatabase() {
        fetch("./quotations")
            .then((res) => {
                if(res.status === 200)
                    return res.json();
                else return false;
            })
            .then(
                (result) => {
                    if(result)
                        this.updateState(result);
                    else {
                        console.log('Nenhuma informação encontrada.');
                    }
                },
                (error) => {
                    console.log('Nenhuma informação encontrada, por favor inicie o comando "php artisan start-feed" com o seu terminal na pasta raiz do projeto.');
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
    
    correctDate(date) {
        
        let dd = function(d) {
            return d < 10 ? '0'+d : d
        };
        
        let stringDate = '';
        
        if(date) {
            let myDate = new Date(date);
            stringDate = dd(myDate.getDate()) + "/" 
                         + dd(myDate.getMonth()+1) + "/" 
                         + myDate.getFullYear() + " às " 
                         + dd(myDate.getHours()) + ":" 
                         + dd(myDate.getMinutes());
        }
        
        return stringDate;
    }    

    needToAsk() {
        if($('#USD').is(':visible') &&
                $('#EUR').is(':visible') &&
                $('#GBP').is(':visible') &&
                $('#ARS').is(':visible')) {
            return false;
        } else return true;
    }

    showCurrencyAgain(currName) {
        
        $('#'+currName).show(300);
        $('#icon'+currName).hide(300);
        
        if(!this.needToAsk()) {
            $('#askToShow').hide();
        }
    }
       
    render() {
        return (
                
            <div className="container main-container">
                <div className="row first-row  justify-content-center">
                    <div className="col-md-6">
                        <h1>Insta Currency é o APP que mostra o valor atual em R$ (reais) das principais moedas do mercado mundial.</h1> 
                    </div>
                    <div className="col-md-3">
                    <p>Uma nova consulta por atualizações nos valores é feita automaticamente à cada 5 minutos pelo nosso sistema, portanto, relaxe. Se algo mudar, você saberá! <i className="far fa-smile"></i></p> 
                    </div>
                </div>

                <div className="row  justify-content-center">
                    <div className="col-auto">&nbsp;</div>
                    <div className="col-auto bold" id="askToShow">
                        Mostrar:&nbsp;
                            <span className="currencyIcon btn btn-success" id="iconUSD" onClick={() => {this.showCurrencyAgain('USD')}}>USD</span>&nbsp; 
                            <span className="currencyIcon btn btn-success" id="iconEUR" onClick={() => {this.showCurrencyAgain('EUR')}}>EUR</span>&nbsp;
                            <span className="currencyIcon btn btn-success" id="iconGBP" onClick={() => {this.showCurrencyAgain('GBP')}}>GBP</span>&nbsp;
                            <span className="currencyIcon btn btn-success" id="iconARS" onClick={() => {this.showCurrencyAgain('ARS')}}>ARS</span>
                    </div>
                </div>
                
                <div className="row second-row justify-content-center">   
                    <div className="col col-md-auto" id="relogio">
                        <span className="bold fz-28">ATUALIZADO EM: </span>
                    </div>
                    <div className="col col-md-auto" id="relogio">
                        <span className="fz-28">{this.correctDate(this.state.updated_at)}</span>
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
