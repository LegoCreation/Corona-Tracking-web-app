const { expect } = require('chai');
const chai = require('chai');
const { JSDOM } = require('jsdom');
const request = require('supertest');

describe('GET /users', function() {
  it('return list of users', function() {
    return request(app)
      .get('/users')
      .expect(200)
      .expect('Content-Type',/json/)
  })
})