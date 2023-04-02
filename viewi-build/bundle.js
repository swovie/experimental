/*!
 * Viewi
 * (c) 2020-now Ivan Voitovych
 * Released under the MIT License.
 */
function implode (glue, pieces) {
  var i = ''
  var retVal = ''
  var tGlue = ''
  if (arguments.length === 1) {
    pieces = glue
    glue = ''
  }
  if (typeof pieces === 'object') {
    if (Object.prototype.toString.call(pieces) === '[object Array]') {
      return pieces.join(glue)
    }
    for (i in pieces) {
      retVal += tGlue + pieces[i]
      tGlue = glue
    }
    return retVal
  }
  return pieces
}


function json_encode (mixedVal) { 
  var $global = (typeof window !== 'undefined' ? window : global)
  $global.$locutus = $global.$locutus || {}
  var $locutus = $global.$locutus
  $locutus.php = $locutus.php || {}
  var json = $global.JSON
  var retVal
  try {
    if (typeof json === 'object' && typeof json.stringify === 'function') {
      retVal = json.stringify(mixedVal)
      if (retVal === undefined) {
        throw new SyntaxError('json_encode')
      }
      return retVal
    }
    var value = mixedVal
    var quote = function (string) {
      var escapeChars = [
        '\u0000-\u001f',
        '\u007f-\u009f',
        '\u00ad',
        '\u0600-\u0604',
        '\u070f',
        '\u17b4',
        '\u17b5',
        '\u200c-\u200f',
        '\u2028-\u202f',
        '\u2060-\u206f',
        '\ufeff',
        '\ufff0-\uffff'
      ].join('')
      var escapable = new RegExp('[\\"' + escapeChars + ']', 'g')
      var meta = {
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"': '\\"',
        '\\': '\\\\'
      }
      escapable.lastIndex = 0
      return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
        var c = meta[a]
        return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0)
          .toString(16))
          .slice(-4)
      }) + '"' : '"' + string + '"'
    }
    var _str = function (key, holder) {
      var gap = ''
      var indent = '    '
      var i = 0
      var k = ''
      var v = ''
      var length = 0
      var mind = gap
      var partial = []
      var value = holder[key]
      if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
        value = value.toJSON(key)
      }
      switch (typeof value) {
        case 'string':
          return quote(value)
        case 'number':
          return isFinite(value) ? String(value) : 'null'
        case 'boolean':
          return String(value)
        case 'object':
          if (!value) {
            return 'null'
          }
          gap += indent
          partial = []
          if (Object.prototype.toString.apply(value) === '[object Array]') {
            length = value.length
            for (i = 0; i < length; i += 1) {
              partial[i] = _str(i, value) || 'null'
            }
            v = partial.length === 0 ? '[]' : gap
              ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']'
              : '[' + partial.join(',') + ']'
            return v
          }
          for (k in value) {
            if (Object.hasOwnProperty.call(value, k)) {
              v = _str(k, value)
              if (v) {
                partial.push(quote(k) + (gap ? ': ' : ':') + v)
              }
            }
          }
          v = partial.length === 0 ? '{}' : gap
            ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}'
            : '{' + partial.join(',') + '}'
          return v
        case 'undefined':
        case 'function':
        default:
          throw new SyntaxError('json_encode')
      }
    }
    return _str('', {
      '': value
    })
  } catch (err) {
    if (!(err instanceof SyntaxError)) {
      throw new Error('Unexpected error type in json_encode()')
    }
    $locutus.php.last_error_json = 4
    return null
  }
}


var viewiBundleEntry = function (exports, bring) {
    var $base = bring('$base');
    var notify = bring('notify');
var MenuBar = function () {
    var $this = this;
    $base(this);
};

    exports.MenuBar = MenuBar;

var HomePage = function () {
    var $this = this;
    $base(this);
    this.title = 'Hello World';
};

    exports.HomePage = HomePage;

var Layout = function () {
    var $this = this;
    $base(this);
    this.title = 'Viewi';
};

    exports.Layout = Layout;

var NotFoundPage = function () {
    var $this = this;
    $base(this);
};

    exports.NotFoundPage = NotFoundPage;

var CssBundle = function () {
    var $this = this;
    $base(this);
    this.links = [];
    this.link = '';
    this.minify = false;
    this.combine = false;
    this.inline = false;
    this.shakeTree = false;
    
    this.__version = function () {
        var key = implode('|',$this.links);
        key += $this.link;
        key += $this.minify ? '1':'0';
        key += $this.inline ? '1':'0';
        key += $this.shakeTree ? '1':'0';
        key += $this.combine ? '1':'0';
        return key;
    };
};

    exports.CssBundle = CssBundle;

exports.AsyncStateManager = function () { };

var OnReady = bring('OnReady');
var ajax = bring('ajax');

var HttpClient = function () {
    this.response = null;
    this.interceptors = [];
    this.options = {};
    var $this = this;
    var isObject = function (variable) {
        return typeof variable === 'object' &&
            !Array.isArray(variable) &&
            variable !== null
    };

    this.request = function (type, url, data, options) {
        if (typeof data === 'undefined') {
            data = null;
        }
        this.setOptions(options);
        if (typeof viewiScopeData !== 'undefined') {
            var requestKey = type.toLowerCase() + '_' + url + '_' + JSON.stringify(data);
            if (requestKey in viewiScopeData) {
                return new OnReady(function (onOk, onError) {
                    onOk(viewiScopeData[requestKey]);
                    delete viewiScopeData[requestKey];
                });
            }
        }
        var resolver = ajax.request(type, url, data, this.options);
        if (this.interceptors.length > 0) {
            var nextHandler = null;
            var handler = null;
            var lastHandler = null;
            var finalResolve = null;
            var finalReject = null;
            var response = {
                success: false,
                content: null,
                canceled: false,
                headers: {},
                status: 0
            };
            var makeRequest = function (after) {
                // console.log('==Request==');
                lastHandler.after = after;
                resolver.then(function (data) {
                    response.success = true;
                    response.content = data;
                    after(lastHandler.next);
                }, function (error) {
                    response.content = error;
                    after(lastHandler.next);
                });
            };
            // var handlers = [];
            for (var i = this.interceptors.length - 1; i >= 0; i--) {
                var interceptor = this.interceptors[i];
                var entryCall = interceptor[0][interceptor[1]];

                handler = {
                    response: response,
                    handle: makeRequest,
                    onHandle: entryCall,
                    httpClient: $this,
                    reject: finalReject,
                    after: function () {
                        // console.log('empty after');
                    },
                    next: function () {
                        // console.log('next called', this);
                        if (this.previousHandler) {
                            this.previousHandler.after(this.previousHandler.next);
                        } else {
                            // this.after(function () {
                            // console.log('--Resolving data--');
                            if (response.success) {
                                finalResolve(response.content);
                            } else {
                                finalReject(response.content);
                            }
                            // });
                        }
                        // call nextHandler.after(nextHandler.next);
                    }
                };
                if (!lastHandler) {
                    lastHandler = handler;
                }
                // handlers.unshift(handler);
                handler.next = handler.next.bind(handler);
                if (nextHandler) {
                    handler.nextHandler = nextHandler;
                    // (function (nextHandler, handler) {
                    //     nextHandler.handle = handler.onHandle
                    // })(nextHandler, handler);  
                    nextHandler.previousHandler = handler;
                    handler.handle = (function (nextHandler) {
                        return function (after) {
                            nextHandler.previousHandler.after = after;
                            nextHandler.reject = nextHandler.previousHandler.reject;
                            nextHandler.onHandle(nextHandler);
                            // console.log('after', nextHandler);
                        };
                    })(nextHandler);
                }
                nextHandler = handler;
            }
            // console.log(handlers);

            return new OnReady(function (resolve, reject) {
                finalResolve = resolve;
                finalReject = reject;
                handler.reject = reject;
                handler.onHandle(handler);
            });
            // OLD
            // for (var i = this.interceptors.length - 1; i >= 0; i--) {
            //     var httpMiddleWare = this.interceptors[i];
            //     var nextAction = resolver.action;
            //     resolver = (function (nextAction) {
            //         return new OnReady(function (onOk, onError) {
            //             httpMiddleWare[0][httpMiddleWare[1]]($this,
            //                 // next
            //                 function () {
            //                     nextAction(onOk, onError);
            //                 },
            //                 // onError
            //                 onError
            //             );
            //         })
            //     })(nextAction);
            // }
        }
        return resolver;
    };

    this.get = function (url, options) {
        var resolver = $this.request('GET', url, null, options);
        return resolver;
    };

    this.post = function (url, data, options) {
        var resolver = $this.request('POST', url, data, options);
        return resolver;
    };

    this.put = function (url, data, options) {
        var resolver = $this.request('PUT', url, data, options);
        return resolver;
    };

    this.delete = function (url, data, options) {
        var resolver = $this.request('DELETE', url, data, options);
        return resolver;
    };

    this.with = function (interceptor) {
        var client = new HttpClient();
        client.interceptors = this.interceptors.slice();
        client.interceptors.push(interceptor);
        client.options = Object.assign({}, this.options); // TODO: deep clone
        for (var k in client.options) {
            if (isObject(client.options[k])) {
                client.options[k] = Object.assign({}, client.options[k]);
            }
        }
        return client;
    }

    this.setOptions = function (options) {
        for (var k in options) {
            if (k === 'headers') {
                this.options[k] = Object.assign(this.options[k] || {}, options[k]);
            } else {
                this.options[k] = options[k];
            }
        }
    }
};
exports.HttpClient = HttpClient;

var ViewiScripts = function (httpClient, _asyncStateManager) {
    var $this = this;
    $base(this);
    var http = null;
    var asyncStateManager = null;
    this.responses = '{}';
    
    this.__construct = function (httpClient, _asyncStateManager) {
        http = httpClient;
        asyncStateManager = _asyncStateManager;
        
        return; // data scripts only for backend;
        var subscription = asyncStateManager.subscribe('httpReady');
        subscription.then(function () {
            $this.responses = json_encode(http.getScopeResponses());
        });
    };

    this.getDataScript = function () {
        
        return '<script>/** BLANK */</script>'; // data scripts only for backend;
        return "<script>window.viewiScopeData = " + $this.responses + ";</script>";
    };

    this.__construct.apply(this, arguments);
};

    exports.ViewiScripts = ViewiScripts;

};