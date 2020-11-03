import React, { Component } from 'react'

export default class FiltersPane extends Component {

    setGETValue(name, value) {
        let urlParams = new URLSearchParams(window.location.search);
        urlParams.set(name, value)
        return window.location.pathname + "?" + urlParams.toString()
    }

    removeFilter(filters, filterName, filterValue) {
        return filters.filter((filter) => !(filter[0] == filterName && filter[1] == filterValue))
    }

    removeFiltersAll(filters, filterName) {
        return filters.filter((filter) => !(filter[0] == filterName))
    }

    addFilter(filters, filterName, filterValue) {
        let f = filters;
        f.push([filterName, filterValue])
        return f
    }

    filterToString(filters) {
        let search = ''
        filters.map(filter => {
            search = search + filter[0] + ':' + filter[1] + ','
        })
        return search.substr(0, search.length - 1)
    }

    render() {
        let filters = this.props.filters;
        return <React.Fragment>
            {this.props.brands !== undefined && this.props.brands !== null ?
                <div className="filter-widget">
                    <h4 className="fw-title">Brands</h4>
                    <ul className="filter-catagories">
                        {this.props.brands.map(brand =>
                            <div className="fw-brand-check" key={brand.id}>
                                <div className="bc-item">
                                    <label htmlFor={"brand-" + brand.id}>
                                        {brand.name}
                                        <input type="checkbox" id={"brand-" + brand.id} defaultChecked={this.props.filtersString !== null ? this.props.filtersString.search("brand_id:" + brand.id) !== -1 : false} />
                                        <span className="checkmark" onClick={() => {
                                            if (this.props.filtersString == null) window.location = this.setGETValue('filters', this.filterToString(this.addFilter(this.props.appliedFilters, 'brand_id', brand.id)));
                                            if (this.props.filtersString !== null) if (this.props.filtersString.search("brand_id:" + brand.id) !== -1 == false) window.location = this.setGETValue('filters', this.filterToString(this.addFilter(this.props.appliedFilters, 'brand_id', brand.id)));
                                            if (this.props.filtersString !== null) if (this.props.filtersString.search("brand_id:" + brand.id) !== -1 == true) window.location = this.setGETValue('filters', this.filterToString(this.removeFilter(this.props.appliedFilters, 'brand_id', brand.id)));
                                        }}></span>
                                    </label>
                                </div>
                            </div>
                        )}
                    </ul>
                </div> : null}
            <div className="filter-widget">
                <h4 className="fw-title">Filtered</h4>
                <div className="fw-tags">
                    {Object.keys(filters).map(key => {
                        return (filters[key]).values.map((val, index) => {
                            return val[1] ? <a key={key + val[0]}>{(filters[key]).name}: {val[0]} {(filters[key]).unit}</a> : null
                        })
                    }
                    )}
                    <a href={window.location.pathname}><i className="fa fa-times"></i>Clear All</a>
                </div>
            </div>
            {
                Object.keys(filters).map(key => {
                    if ((filters[key]).name.toLowerCase() == 'size') {
                        return <div className="filter-widget" key={key}>
                            <h4 className="fw-title">Size ({(filters[key]).unit})</h4>
                            <div className="fw-size-choose">
                                {(filters[key]).values.map((val, index) => {
                                    return <div className="sc-item" key={key + "-" + index}>
                                        <input type="radio" id={"s-" + val[0]} selected={val[1]} />
                                        <label htmlFor={"s-" + val[0]}>{val[0]}</label>
                                    </div>
                                })}
                            </div>
                        </div>
                    }
                    if ((filters[key]).name.toLowerCase() == 'colour') {
                        return <div className="filter-widget" key={key}>
                            <h4 className="fw-title">Color</h4>
                            <div className="fw-color-choose">
                                {(filters[key]).values.map((val, index) => {
                                    return <div className="cs-item" key={key + "-" + index}>
                                        <input type="radio" id={"cs-" + val[0]} selected={val[1]} />
                                        <label class={"cs-" + val[0]} htmlFor={"cs-" + val[0]}>{val[0]}</label>
                                    </div>
                                })}
                            </div>
                        </div>
                    }
                    return <div className="filter-widget" key={key}>
                        <h4 className="fw-title">{(filters[key]).name}</h4>
                        {(filters[key]).values.map((val, index) => {
                            return <div className="fw-brand-check" key={key + "-" + index}>
                                <div className="bc-item">
                                    <label htmlFor={"bc-" + key + "-" + index}>
                                        {val[0]} {(filters[key]).unit}
                                        <input type="checkbox" id={"bc-" + key + "-" + index} defaultChecked={val[1]} />
                                        <span className="checkmark" onClick={() => {
                                            if (val[1] == false) window.location = this.setGETValue('filters', this.filterToString(this.addFilter(this.props.appliedFilters, key, val[0])));
                                            if (val[1] == true) window.location = this.setGETValue('filters', this.filterToString(this.removeFilter(this.props.appliedFilters, key, val[0])));
                                        }}></span>
                                    </label>
                                </div>
                            </div>
                        })}
                    </div>
                })
            }

            <div className="filter-widget">
                <h4 className="fw-title">Price</h4>
                <div className="filter-range-wrap">
                    <div className="range-slider">
                        <div className="price-input">
                            <input type="text" id="minamount" defaultValue="0" />
                            <input type="text" id="maxamount" defaultValue="99999" />
                        </div>
                    </div>
                    {/* <div className="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                        data-min="0" data-max="9999">
                        <div className="ui-slider-range ui-corner-all ui-widget-header"></div>
                        <span tabIndex="0" className="ui-slider-handle ui-corner-all ui-state-default"></span>
                        <span tabIndex="0" className="ui-slider-handle ui-corner-all ui-state-default"></span>
                    </div> */}
                </div>
                <a onClick={() => {
                    let filters = this.removeFiltersAll(this.props.appliedFilters, 'price')
                    window.location = this.setGETValue('filters', this.filterToString(this.addFilter(filters, 'price', document.getElementById('minamount').value + '-' + document.getElementById('maxamount').value)))
                }} className="filter-btn">Filter</a>
            </div>
        </React.Fragment>
    }
}