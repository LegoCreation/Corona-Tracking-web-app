const { expect } = require('chai');
const chai = require('chai');
const { JSDOM } = require('jsdom');

chai.use(require('chai-dom'));
require('jsdom-global')();

describe('./index.php', () => {
  beforeEach((done) => {
   JSDOM.fromFile('./index.php')
   .then((dom) => {
     global.document = dom.window.document
   })
 .then(done, done);
 })



 describe("Website Title", () => {
 it("                Corona Archive", () => {
  let element = document.querySelector('h3')
  expect(element).to.have.text("                Corona Archive")
 })
})
})